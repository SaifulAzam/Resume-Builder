<?php

namespace App\Http\Controllers;

use App\Constants\ProfilePermissionError;
use App\Constants\ResumePermissionError;
use App\Constants\UserPermissionError;
use App\Exceptions\NoPermissionException;
use App\Resume;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Image;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class DashboardController extends Controller
{
    public function deleteResumeTemplate(Request $request) {
        $request->validate([
            'template' => 'required|string'
        ]);

        Resume::deleteTemplate(
            $request->input('template')
        );

        return redirect()->back();
    }

    public function deleteUser($username) {
        $profile = User::where('username', $username)->firstOrFail();
        $user    = Auth::user();

        if ((int) $profile->id !== (int) $user->id) {
            if (! $user->hasAnyRole(['administrator', 'moderator'])) {
                throw new NoPermissionException( ProfilePermissionError::DELETE );
            }
        } else {
            $profile->delete();
            return redirect()->route('resumes.create');
        }

        $profile->delete();
        return redirect()->back();
    }

    public function showProfile($username) {
        $profile = User::where('username', $username)->firstOrFail();
        $user    = Auth::user();

        if ((int) $profile->id !== (int) $user->id) {
            if (! $user->hasAnyRole(['administrator', 'moderator'])) {
                throw new NoPermissionException( ProfilePermissionError::VIEW );
            }
        }

        return view('pages.dashboard.profile', [
            'profile' => $profile
        ]);
    }

    public function showResumeTemplates() {
        $profile = Auth::user();
        $templates = Resume::getTemplates();

        if (! $profile->hasAnyRole(['administrator', 'moderator'])) {
            throw new NoPermissionException( ResumePermissionError::TEMPLATE );
        }

        return view('pages.dashboard.templates', [
            'profile'   => $profile,
            'templates' => $templates
        ]);
    }

    public function showStatistics($username) {
        $profile = User::with('resumes')->where('username', $username)->firstOrFail();
        $user    = Auth::user();

        $super_user = $user->hasAnyRole(['administrator', 'moderator']);

        $total_resume_count = null;
        $total_revenue      = null;
        $total_user_count   = null;

        if ((int) $profile->id !== (int) $user->id) {
            if (! $super_user) {
                throw new NoPermissionException( ProfilePermissionError::VIEW );
            }
        } elseif ($super_user) {
            $total_resume_count = Resume::all()->count();
            $total_revenue      = 265.5;
            $total_user_count   = User::all()->count();
        }

        return view('pages.dashboard.statistics', [
            'profile' => $profile,
            'total_resume_count' => $total_resume_count,
            'total_revenue' => $total_revenue,
            'total_user_count' => $total_user_count
        ]);
    }

    public function showUsers() {
        $profile = Auth::user();
        $users   = User::paginate();

        if (! $profile->hasAnyRole(['administrator', 'moderator'])) {
            throw new NoPermissionException( UserPermissionError::VIEW );
        }

        return view('pages.dashboard.users', [
            'profile' => $profile,
            'users'   => $users  
        ]);
    }

    public function showUploadResumeTemplateForm() {
        $profile = Auth::user();

        if (! $profile->hasAnyRole(['administrator', 'moderator'])) {
            throw new NoPermissionException( ResumePermissionError::TEMPLATE );
        }

        return view('pages.dashboard.templates-upload', [
            'profile' => $profile
        ]);
    }

    public function updateProfile(Request $request, $username) {
        $profile = User::where('username', $username)->firstOrFail();
        $user    = Auth::user();

        $props = $request->validate([
            'avatar'   => 'image',
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($profile->id)
            ],
            'name'     => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        if ((int) $profile->id !== (int) $user->id) {
            if (! $user->hasAnyRole(['administrator', 'moderator'])) {
                throw new NoPermissionException( ProfilePermissionError::UPDATE );
            }
        }

        foreach ($props as $key => $value) {
            if ($key === 'avatar') {
                continue;
            } elseif ($key === 'password') {
                if (empty($value)) {
                    continue;
                }

                $value = Hash::make($value);
            }

            $profile->{$key} = $value;
        }

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $filename = 'uploads/avatars/' . $filename;

            Image::make($avatar)->resize(300, 300)->save(public_path($filename));

            $profile->avatar = asset($filename);
        }

        $profile->save();
        return redirect()->route('dashboard.profile', ['username' => $profile->username]);
    }

    public function uploadResumeTemplate(Request $request) {
        $request->validate([
            'template' => 'required|mimetypes:application/zip,application/x-zip-compressed,multipart/x-zip,application/x-compressed'
        ]);

        $zip = new \ZipArchive();
        $res = $zip->open(
            $request->file('template'),
            \ZipArchive::CHECKCONS
        );

        if ($res === true) {
            $zip->extractTo(resource_path("views\\resumes\\test\\"));
        }

        return redirect()->route("dashboard.resumes.templates");
    }
}
