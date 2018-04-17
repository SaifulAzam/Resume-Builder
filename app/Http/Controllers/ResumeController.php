<?php

namespace App\Http\Controllers;

use App\Contracts\ResumeInterface;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function createResume() {
        $author = '';

        // Determine whether the authenticated user is trying to create a resume
        // or an unauthenticated user since we need to restrict the
        // authenticated user from creating the resume if they have no
        // permission.
        if (Auth::check()) {
            $author = Auth::user();
            $user   = $author;

            if (! $user->hasPermissionTo('create resumes')) {
                return redirect()->route('resumes.error')
                    ->withErrors("message", "Sorry! You don't have permission to create a resume.")
                    ->with([
                        'author_id' => $request->input('author_id'),
                        'data'      => $request->input('data'),
                        'template'  => $request->input('template'),
                        'title'     => $request->input('title'),
                    ]);
            }

            // Next, we'll check whether the user is a person with super
            // privillages and is trying to create a resume for some other user.
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
     * @throws \Exception
     */
    public function deleteResume($resume_id) {
        $resume = Resume::with('author')->findOrFail($resume_id);
        $author = $resume->author;

        // To delete a resume either the user should be authenticated or they
        // should hold the token with them to enjoy the resume owner
        // privillages.
        if (Auth::check()) {
            $user = Auth::user();

            // Next, we'll determine whether the authenticated user has not
            // been restricted from deleting the resume. Or the user should be
            // a person with super privillage if they are not the owner of the
            // resume.
            if (! $user->hasPermissionTo('delete resumes')) {
                return redirect()->back()->withErrors("message", "Sorry! You don't have permission to delete a resume.");
            } elseif ((int) $user->id !== (int) $author->id && $user->hasAnyRole(['administrator', 'moderator'])) {
                return redirect()->back()->withErrors("message", "Sorry! You don't have permission to delete a resume.");
            }
        } elseif (! $resume->validateToken()) {
          return redirect()->back()->withErrors("message", "Sorry! You don't have permission to delete a resume.");
        }

        $resume->delete();
        return redirect()->route('resumes.single')->with('status', 'deleted');
    }

    /**
     * Displays all the resumes.
     *
     * @param  int $user_id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showAllResumes($user_id = null) {
        if (! Auth::check()) {
            return redirect()->route('resumes.error')
                ->withErrors("message", "Sorry! You don't have permission to view the resumes.");
        }

        $resumes = new Resume;
        $user   = Auth::user();

        // We'll determine whether resumes are being requested of a particular
        // user or all and then display the resumes accordingly.
        if (! empty($user_id)) {
            if ((int) $user->id !== (int) $user_id && ! $user->hasAnyRole(['administrator', 'moderator'])) {
                return redirect()->route('resumes.error')
                    ->withErrors("message", "Sorry! You don't have permission to view the resumes.");
            }

            $resumes = $user->resumes;
        } else {
            if (! $user->hasAnyRole(['administrator', 'moderator'])) {
                return redirect()->route('resumes.error')
                    ->withErrors("message", "Sorry! You don't have permission to view the resumes.");
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
     */
    public function showResume($resume_id) {
        $resume = Resume::with(['author', 'token'])->findOrFail($resume_id);
        $author = $resume->author;

        // Determine whether the user is authenticated or holds the resume token
        // to access the resume.
        if (Auth::check()) {
            $user = Auth::user();

            // Next, we'll check whether the authenticated user is the owner of
            // the resume or holds any super privillage and if none of the case
            // apply then we'll restrict the user from accessing the resume and
            // redirect him with error messages to explain him better about the
            // issue.
            if ((int) $user->id !== (int) $author->id) {
                return redirect()->route('resumes.error')
                    ->withErrors("message", "Sorry! You don't have permission to view the resumes.");
            } elseif (! $user->hasAnyRole(['administrator', 'moderator'])) {
                return redirect()->route('resumes.error')
                    ->withErrors("message", "Sorry! You don't have permission to view the resumes.");
            }
        } elseif (! $resume->validateToken()) {
            return redirect()->route('resumes.error')
                ->withErrors("message", "Sorry! You don't have permission to view the resumes.");
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
                return redirect()->back()
                    ->withErrors("message", "Sorry! You don't have permission to create a resume.")
                    ->with([
                        'author_id' => $request->input('author_id'),
                        'data'      => $request->input('data'),
                        'template'  => $request->input('template'),
                        'title'     => $request->input('title'),
                    ]);
            }

            // Next, we'll check whether the user is a person with super
            // privillages and is trying to create a resume for some other user.
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
            // a person with super privillage if they are not the owner of the
            // resume.
            if (! $user->hasPermissionTo('update resumes')) {
                return redirect()->back()->withErrors("message", "Sorry! You don't have permission to update a resume.");
            } elseif ((int) $user->id !== (int) $author->id && $user->hasAnyRole(['administrator', 'moderator'])) {
                return redirect()->back()->withErrors("message", "Sorry! You don't have permission to update a resume.");
            }
        } elseif (! $resume->validateToken()) {
            return redirect()->back()->withErrors("message", "Sorry! You don't have permission to update a resume.");
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
