<?php

namespace App\Http\Controllers;

use App\Constants\ResumePermissionError;
use App\Exceptions\NoPermissionException;
use App\Resume;
use App\User;
use \Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ResumeController extends Controller
{
    /**
     * Deletes the resume with supplied resume id.
     *
     * @param  int $resume_id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws NoPermissionException
     * @throws \Exception
     */
    public function deleteResume($resume_id) {
        $resume = Resume::with('author')->findOrFail($resume_id);
        $author = $resume->author;

        // To delete a resume either the user should be authenticated or they
        // should hold the token with them to enjoy the resume owner
        // privileges.
        if (Auth::check()) {
            $user = Auth::user();

            // Next, we'll determine whether the authenticated user has not
            // been restricted from deleting the resume. Or the user should be
            // a person with super privilege if they are not the owner of the
            // resume.
            if ((int) $user->id !== (int) $author->id) {
                if (! $user->hasAnyRole(['administrator', 'moderator'])) {
                    throw new NoPermissionException( ResumePermissionError::VIEW );
                }
            }
        } elseif (! $resume->validateToken()) {
            throw new NoPermissionException( ResumePermissionError::VIEW );
        }

        $resume->delete();
        return redirect()->route('resumes.create')->with('status', 'deleted');
    }

    public function downloadResume($resume_id) {
        $resume = Resume::with("author")->findOrFail($resume_id);
        $author = $resume->author;

        if (Auth::check()) {
            $user = Auth::user();

            // Next, we'll determine whether the authenticated user has not
            // been restricted from viewing the resume. Or the user should be
            // a person with super privilege if they are not the owner of the
            // resume.
            if ((int) $user->id !== (int) $author->id) {
                if (! $user->hasAnyRole(['administrator', 'moderator'])) {
                    throw new NoPermissionException( ResumePermissionError::VIEW );
                }
            }
        } elseif (! $resume->validateToken()) {
            throw new NoPermissionException( ResumePermissionError::VIEW );
        }

        $pdf_name = sha1(Carbon::now()) . '.pdf';

        $data     = json_decode($resume->data);
        $template = $resume->template;

        $contact_info = array_filter($data, function ($temp) {
            return $temp->type === 'contact-information';
        });

        return PDF::loadView('resumes.' . $template . '.index', [
            'author'       => $resume->author,
            'contact_info' => $contact_info[0],
            'data'         => $data,
            'template'     => $template,
            'title'        => $resume->title,
        ])
            ->setPaper('a4')
            ->download($pdf_name);
    }

    /**
     * Duplicates the resume in the database.
     *
     * @param  int $resume_id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws NoPermissionException
     */
    public function duplicateResume($resume_id) {
        $resume = Resume::with('author')->findOrFail($resume_id);
        $author = $resume->author;

        // To duplicate a resume either the user should be the owner of
        // it or they must hold the super user privilege.
        if (Auth::check()) {
            $user = Auth::user();

            // Next, we'll determine whether the authenticated user has not
            // been restricted from creating the resume. Or the user should be
            // a person with super privilege if they are not the owner of the
            // resume.
            if (! $user->hasPermissionTo('create resumes')) {
                throw new NoPermissionException( ResumePermissionError::CREATE );
            } elseif ((int) $user->id !== (int) $author->id) {
                if (! $user->hasAnyRole(['administrator', 'moderator'])) {
                    throw new NoPermissionException( ResumePermissionError::CREATE );
                }
            }
        }

        $new_resume = $resume->replicate();
        $new_resume->save();

        return redirect()->route('resumes.single', ['resume_id' => $new_resume->id])->with('status', 'created');
    }

    /**
     * Displays all the resumes.
     *
     * @param  string $username
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     *
     * @throws NoPermissionException
     */
    public function showAllResumes($username = null) {
        $resumes = new Resume;
        $user    = Auth::user();
        $profile = $user;

        $is_super_user = $user->hasAnyRole(['administrator', 'moderator']);

        // We'll determine whether resumes are being requested of a particular
        // user or all and then display the resumes accordingly.
        if (! empty($username)) {
            $author = User::where('username', $username)->firstOrFail();

            // Restrict the user to access the resumes of other users if
            // they are not the users with super privileges.
            if ((int) $user->id !== (int) $author->id && ! $is_super_user) {
                throw new NoPermissionException( ResumePermissionError::VIEW );
            }

            $profile = $author;
            $resumes = Resume::where('author_id', $author->id);
        } else {
            if (! $is_super_user) {
                return redirect()->route('dashboard.resumes', ['username' => $user->username]);
            }

            $resumes = $resumes->with('author');
        }

        $resumes = $resumes->paginate();

        return view('pages.dashboard.resumes', [
            'profile' => $profile,
            'resumes' => $resumes
        ]);
    }

    /**
     * Displays the resume with supplied resume id.
     *
     * @param  int $resume_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     *
     * @throws NoPermissionException
     */
    public function showResume($resume_id) {
        $resume = Resume::with(['author', 'token'])->findOrFail($resume_id);
        $author = $resume->author;
        $user   = null;
        $route  = null;
        $form_method = "POST";

        // Determine whether the user is authenticated or holds the resume token
        // to access the resume.
        if (Auth::check()) {
            $user = Auth::user();

            // Next, we'll check whether the authenticated user is the owner of
            // the resume or holds any super privilege and if none of the case
            // apply then we'll restrict the user from accessing the resume and
            // redirect him with error messages to explain him better about the
            // issue.
            if ((int) $user->id !== (int) $author->id) {
                if (! $user->hasAnyRole(['administrator', 'moderator'])) {
                    throw new NoPermissionException( ResumePermissionError::VIEW );
                }
            }

            $route = route('resumes.update', ['resume_id' => $resume->id]);
            $form_method = "PUT";
        } else{
            if (! $resume->validateToken()) {
                throw new NoPermissionException( ResumePermissionError::VIEW );
            }

            $route = route('resumes.download', ['resume_id' => $resume->id]);
        }

        return view('pages.resume-form', [
            'author'          => $resume->author,
            'created_at'      => $resume->created_at->toDateTimeString(),
            'data'            => $resume->data,
            'form_action_url' => $route,
            'form_method'     => $form_method,
            'resume_id'       => $resume->id,
            'template'        => $resume->template,
            'title'           => $resume->title,
            'updated_at'      => $resume->updated_at->toDateTimeString(),
            'user'            => $user
        ]);
    }

    /**
     * Displays a form to create a new resume.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     *
     * @throws NoPermissionException
     */
    public function showResumeForm(Request $request) {
        $author = null;
        $user   = null;

        // Determine whether the authenticated user is trying to create a resume
        // or an unauthenticated user since we need to restrict the
        // authenticated user from creating the resume if they have no
        // permission.
        if (Auth::check()) {
            $author = Auth::user();
            $user   = $author;

            if (! $user->hasPermissionTo('create resumes')) {
                throw new NoPermissionException( ResumePermissionError::CREATE );
            }

            // Next, we'll check whether the user is a person with super
            // privileges and is trying to create a resume for some other user.
            // And if so, then we'll change author of the resume.
            if ($user->hasAnyRole(['administrator', 'moderator'])) {
                if ($request->has('author_id')) {
                    $author = User::findOrFail($request->input('author_id'));
                }
            }
        }

        $templates = Resume::getTemplates();

        return view('pages.resume-form', [
            'author'          => $author,
            'form_action_url' => route('resumes.store'),
            'form_method'     => 'POST',
            'template'        => $templates[0]['name'],
            'title'           => 'New Resume',
            'user'            => $user
        ]);
    }

    /**
     * Stores the new resume into the database.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  bool $redirect
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws NoPermissionException
     */
    public function storeResume(Request $request, bool $redirect = true) {
        if ($request->has('registration') && (int) $request->input('registration') === 1) {
            $request->validate([
                'author_id'          => 'exists:users,id',
                'data'               => 'required',
                'template'           => 'required|string',
                'title'              => 'required|string',
                'registration_email' => 'required|email|unique:users,email',
                'registration_name'  => 'required|string',
                'registration_pass'  => 'required|string|min:6|max:16',
            ]);
        } else {
            $request->validate([
                'author_id'          => 'exists:users,id',
                'data'               => 'required',
                'template'           => 'required|string',
                'title'              => 'required|string',
            ]);
        }

        // Determine whether the authenticated user is trying to create a resume
        // or an unauthenticated user since we need to restrict the
        // authenticated user from creating the resume if they have no
        // permission.
        if (Auth::check()) {
            $author = Auth::user();
            $user   = $author;

            if (! $user->hasPermissionTo('create resumes')) {
                throw new NoPermissionException( ResumePermissionError::CREATE );
            }

            // Next, we'll check whether the user is a person with super
            // privileges and is trying to create a resume for some other user.
            // And if so, then we'll change author of the resume.
            if ($user->hasAnyRole(['administrator', 'moderator'])) {
                if ($request->has('author_id')) {
                    $author = User::findOrFail($request->input('author_id'));
                }
            }
        } else {
            // If the user is not authenticated then our task is to check
            // whether they're trying to register or otherwise we'll create a
            // random user and assign it the resume since we always need to
            // assign a user to the resume and hence we're restricted to it.
            if ($request->has('registration') && (bool) $request->input('registration') === true) {
                $password = $request->input('registration_pass');

                $author = app('\App\Http\Controllers\Auth\RegisterController')->create([
                    'email'    => $request->input('registration_email'),
                    'name'     => $request->input('registration_name'),
                    'password' => $password
                ]);

                Auth::attempt([
                    'username' => $author->username,
                    'password' => $password
                ]);
            } else {
                $author = User::createRandomUser();
            }
        }

        $data     = $request->input('data');
        $template = $request->input('template');
        $title    = $request->input('title');

        $resume = $author->resumes()->create([
            'data'     => $data,
            'template' => $template,
            'title'    => $title,
        ]);

        // Finally, if the user is not authenticated then we'll generate a token
        // for the user to access the resume anytime in the future through the
        // same browser.
        if (! Auth::check()) {
            $resume->generateToken();
        }

        if ($redirect === false) {
            return $resume;
        }

        return redirect()->route('resumes.single', ['resume_id' => $resume->id])->with('status', 'created');
    }

    /**
     * Updates the resume with new supplied details.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $resume_id
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws NoPermissionException
     */
    public function updateResume(Request $request, $resume_id) {
        $resume = Resume::with(['author', 'token'])->findOrFail($resume_id);
        $author = $resume->author;

        $props = $request->validate([
            'author_id' => 'exists:users,id',
            'data'      => 'required',
            'title'     => 'required|string',
            'template'  => 'required|string',
        ]);

        // Determine whether the user is authenticated or holds the resume token
        // to update the resume.
        if (Auth::check()) {
            $user = Auth::user();

            // Next, we'll determine whether the authenticated user has not
            // been restricted from updating the resume. Or the user should be
            // a person with super privilege if they are not the owner of the
            // resume.
            if (! $user->hasPermissionTo('edit resumes')) {
                throw new NoPermissionException( ResumePermissionError::UPDATE );
            } elseif ((int) $user->id !== (int) $author->id) {
                if (! $user->hasAnyRole(['administrator', 'moderator'])) {
                    throw new NoPermissionException( ResumePermissionError::UPDATE );
                }
            }
        } elseif (! $resume->validateToken()) {
            throw new NoPermissionException( ResumePermissionError::UPDATE );
        }

        // Finally, we'll save the properties of the resume in the database and
        // redirect to the newly updated resume to perform more actions on it.
        foreach ($props as $key => $value) {
            $resume->{$key} = $value;
        }

        $resume->save();
        return redirect()->route('resumes.single', ['resume_id' => $resume->id])->with('status', 'updated');
    }
}
