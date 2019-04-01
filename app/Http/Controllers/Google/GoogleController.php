<?php

namespace App\Http\Controllers\Google;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Socialite;

class GoogleController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();

    }

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleGoogleCallback()
    {

        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('/login');
        }
        // only allow people with @company.com to login

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser = new User;
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id;
            $newUser->create_user_id = 1;
            $newUser->updated_user_id = 1;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect('/home');
        }

    }

    public function facebooklogout(\App\AuthenticateUser $authenticateUser, Request $request, $provider = null)
    {
        return $authenticateUser->deauthorize($this, $provider);
    }

}
