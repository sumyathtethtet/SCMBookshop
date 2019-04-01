<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Services\LoginServiceInterface;
use Session;
use Socialite;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginServiceInterface $loginInterface)
    {
        $this->middleware('guest', ['except' => ['logout']]);
        $this->loginInterface=$loginInterface;

    }

    /**
     * Create a new controller instance for login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // check validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect('/home')->with('success', 'login success');

        } else {
            return redirect()->intended('login')
                ->with('loginError', 'User name or password is incorrect!');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $this->loginInterface->googleLogin();
        }
        return redirect('/home');
    }
    /**
     * Create a new controller instance for logout.
     *
     * @return void
     */
    public function logout(Request $request)
    {
        auth()->logout();
        Session::flush();
        return redirect('/login');
    }
}
