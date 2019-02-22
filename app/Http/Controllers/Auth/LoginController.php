<?php

namespace laravel\Http\Controllers\Auth;

use laravel\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
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
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function login(Request $request)
  {
    $email=$request->email;
    $password=$request->password;
    if(Auth::attempt(['email'=>$email,'password'=>$password])) {
      // Authentication passed...
      Log::info("Login succeeded");

      return redirect('/home');
    }
    Log::info("Login failed");
    return redirect()->intended('login')
      ->with('loginError', 'User name or password is incorrect!');

  }

  public function logout(Request $request) {
    Auth::logout();
    return redirect('/login');
  }
}
