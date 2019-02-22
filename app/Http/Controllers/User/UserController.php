<?php

namespace laravel\Http\Controllers\User;

use laravel\Contracts\Services\User\UserServiceInterface;
use laravel\Http\Controllers\Controller;

class UserController extends Controller
{

  private $userInterface;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(UserServiceInterface $userInterface)
  {

    $this->middleware('auth');
    $this->userInterface = $userInterface;
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    

    return view('login.login', [
      
    ]);
  }
}
