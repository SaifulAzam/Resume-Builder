<?php

namespace App\Http\Controllers;

use App\Constants\ResumePermissionError;
use App\Contracts\ResumeInterface;
use App\Exceptions\NoPermissionException;
use App\Resume;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class ResumeController extends Controller implements ResumeInterface
{
    /**
     * Displays a form to create a new resume.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     *
     * @throws NoPermissionException
     */
    public function createResume(Request $request) {
        $author = '';

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

        return view('pages.resumes-single', [
            'author'          => $author,
            'form_action_url' => route('resumes.store'),
            'title'           => 'New Resume'
        ]);
    }

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
            if (! $user->hasPermissionTo('delete resumes')) {
                throw new NoPermissionException( ResumePermissionError::DELETE );
            } elseif ((int) $user->id !== (int) $author->id && $user->hasAnyRole(['administrator', 'moderator'])) {
                throw new NoPermissionException( ResumePermissionError::DELETE );
            }
        } elseif (! $resume->validateToken()) {
            throw new NoPermissionException( ResumePermissionError::DELETE );
        }

        $resume->delete();
        return redirect()->route('resumes.single')->with('status', 'deleted');
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
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $resumes = new Resume;
        $user   = Auth::user();

        $is_super_user = $user->hasAnyRole(['administrator', 'moderator']);

        // We'll determine whether resumes are being requested of a particular
        // user or all and then display the resumes accordingly.
        if (! empty($username)) {
            $author = User::with('resumes')->where('username', $username)->firstOrFail();

            // Restrict the user to access the resumes of other users if
            // they are not the users with super privileges.
            if ((int) $user->id !== (int) $author->id && ! $is_super_user) {
                throw new NoPermissionException( ResumePermissionError::VIEW );
            }

            $resumes = $author->resumes;
        } else {
            if (! $is_super_user) {
                return redirect()->route('users.resumes', ['username' => $user->username]);
            }

            $resumes = $resumes->all();
        }

        return view('pages.resumes-all', [ 'resumes' => $resumes ]);
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
                throw new NoPermissionException( ResumePermissionError::VIEW );
            } elseif (! $user->hasAnyRole(['administrator', 'moderator'])) {
                throw new NoPermissionException( ResumePermissionError::VIEW );
            }
        } elseif (! $resume->validateToken()) {
            throw new NoPermissionException( ResumePermissionError::VIEW );
        }

        return view('pages.resumes-single', [
            'author'          => $resume->author,
            'data'            => $resume->data,
            'form_action_url' => route('resumes.update'),
            'template'        => $resume->template,
            'title'           => $resume->title
        ]);
    }

    /**
     * Stores the new resume into the database.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws NoPermissionException
     */
    public function storeResume(Request $request) {
        $request->validate([
            'author_id'          => 'exists:users,id',
            'data'               => 'required|array',
            'registration_email' => 'email|unique:users,email',
            'registration_name'  => 'required_if:registration_email|string',
            'registration_pass'  => 'required_if:registration_email|string|min:6|max:16',
            'template'           => 'required|string',
            'title'              => 'required|string',
        ]);

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
            if ($request->has('registration_email') && $request->has('registration_pass')) {
                $username = User::generateUsername();
                $password = $request->input('registration_pass');

                $author = User::create([
                    'email'    => $request->input('registration_email'),
                    'name'     => $request->input('registration_name'),
                    'password' => Hash::make($password),
                    'username' => $username
                ]);

                Auth::attempt([
                    'username' => $username,
                    'password' => $password
                ]);
            } else {
                $author = User::createRandomUser();
            }
        }

        $data     = serialize($request->input('data'));
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
            'data'      => 'required|array',
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
            if (! $user->hasPermissionTo('update resumes')) {
                throw new NoPermissionException( ResumePermissionError::UPDATE );
            } elseif ((int) $user->id !== (int) $author->id && $user->hasAnyRole(['administrator', 'moderator'])) {
                throw new NoPermissionException( ResumePermissionError::UPDATE );
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
