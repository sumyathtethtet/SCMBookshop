<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use App\Http\Controllers\Auth;
use App\Mail\WelcomeMail;




class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','min:6'],               
            'password_confirm' => 'required|min:6|same:password',
            'phone' => 'required|numeric',            
            'dob' => 'required|date',
            'profile'=>'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone'=> $data['phone'],
            'dob'=> $data['dob'],
            'profile'=> $data['profile'],
            'create_user_id' => 1,
            'updated_user_id'=> 1,
             

        ]);
        $profile = time().'.'.request()->profile->getClientOriginalExtension();
        request()->profile->move(public_path('myFile'), $profile);

        $user = 'scm.sumyathtethtet@gmail.com';
        
        Mail::to($data['email'])->send(new WelcomeMail($user));
        
                return $user;
        
        
    }
    // public function mail()
    // {
    //    $user = 'scm.sumyathtethtet@gmail.com';
    //    Mail::to($user)->send(new WelcomeMail($user));
       
    //    return 'Email was sent';
    // }

}

