<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class HomeController extends Controller
{
    //
    public function index()
    {
      return view('home');
    }
    public function mail()
    {
       $user = 'scm.sumyathtethtet@gmail.com';
       Mail::to($user)->send(new WelcomeMail($user));
       
       return 'Email was sent';
    }
}
