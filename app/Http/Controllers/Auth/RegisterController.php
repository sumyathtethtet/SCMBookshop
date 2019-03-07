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
use Illuminate\Auth\Events\Registered;
use App\Contracts\Services\UserServiceInterface;
use Log;

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
    private $userInterface;

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
    
    public function __construct(UserServiceInterface $userInterface)
    {
        $this->middleware('guest');
        $this->userInterface = $userInterface;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->userInterface->create($request->all())));
        $this->sendRegisterMail($request->email);
        return redirect('login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','min:6'],               
            'password_confirm' => ['required','min:6','same:password'],
            'phone' => 'required|numeric',            
            'dob' => 'required|date',
            'profile'=>'required',
        ]);
    }

   
    /**
     * Create a new controller instance to send email after a valid registration.
     *
     * @param  $email
     */
    public function sendRegistermail($email)
    {
        Mail::to($email)->send(new WelcomeMail());
    }
}

