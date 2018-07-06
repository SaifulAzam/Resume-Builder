<?php

namespace App\Http\Controllers;

use App\Constants\ResumePermissionError;
use App\Exceptions\NoPermissionException;
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
    public function showProfile($username) {
        $profile = User::where('username', $username)->firstOrFail();
        $user    = Auth::user();

        if ((int) $profile->id !== (int) $user->id) {
            if ($user->hasAnyRole(['administrator', 'moderator'])) {
                throw new NoPermissionException( ProfilePermissionError::VIEW );
            }
        }

        return view('pages.dashboard.profile', [
            'profile' => $profile
        ]);
    }

    public function showStatistics($username) {
        $profile = User::with('resumes')->where('username', $username)->firstOrFail();
        $user    = Auth::user();

        if ((int) $profile->id !== (int) $user->id) {
            if ($user->hasAnyRole(['administrator', 'moderator'])) {
                throw new NoPermissionException( ProfilePermissionError::VIEW );
            }
        }

        return view('pages.dashboard.statistics', [
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
                Rule::unique('users')->ignore($user->id)
            ],
            'name'     => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        if ((int) $profile->id !== (int) $user->id) {
            if ($user->hasAnyRole(['administrator', 'moderator'])) {
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

            Image::make($avatar)->resize(300, 300)->save( public_path('uploads/avatars/' . $filename ) );

            $profile->avatar = $filename;
        }

        $profile->save();
        return redirect()->route('dashboard.profile', ['username' => $profile->username]);
    }
}
