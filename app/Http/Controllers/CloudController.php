<?php

namespace App\Http\Controllers;

use App\Factory\DropboxFactory;
use App\CloudToken;
use App\User;
use Illuminate\Http\Request;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class CloudController extends Controller
{
    public function connectDropbox($username) {
        session(['dropbox_user' => $username]);

        $callbackUrl = route('dashboard.cloud.dropbox.callback');
        $dropbox = (new DropboxFactory)->create();
        $dropboxAuthHelper = $dropbox->getAuthHelper();

        return redirect(
                $dropboxAuthHelper->getAuthUrl($callbackUrl)
            );
    }

    public function disconnectDropbox($username) {
        $user = User::with(['cloudTokens' => function ($query) {
                    $query->where('name', 'dropbox');
                }])
                    ->where('username', $username)
                    ->firstOrFail();

        CloudToken::whereIn('id', $user->cloudTokens->pluck('id'))->delete(); 

        return redirect()->route('dashboard.cloud', ['username' => $username])
            ->with([
                'message' => 'Successfully disconnected from your Dropbox account.',
                'status'  => 'success'
            ]);
    }

    public function storeDropboxToken(Request $request) {
        $code  = $request->input('code');
        $state = $request->input('state');

        $username = session()->get('dropbox_user');
        $user     = User::where('username', $username)->firstOrFail();

        $callbackUrl = route('dashboard.cloud.dropbox.callback');

        $dropbox = (new DropboxFactory)->create();
        $dropboxAuthHelper = $dropbox->getAuthHelper();

        $accessToken = $dropboxAuthHelper->getAccessToken($code, $state, $callbackUrl);
        $token       = $accessToken->getToken();

        $user->cloudTokens()->create([
            'name'  => 'dropbox',
            'value' => $token
        ]);

        return redirect()->route('dashboard.cloud', ['username' => $username])
            ->with([
                'message' => 'Successfully connected to your Dropbox account.',
                'status'  => 'success'
            ]);
    }
}
