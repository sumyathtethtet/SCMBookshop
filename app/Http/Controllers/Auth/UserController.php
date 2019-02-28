<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
class UserController extends Controller
{
    //
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
    
    public function create()
    {
        return view('auth.register');
    }
    public static function store(Request $request)
    {
        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $phone=$request->phone;
        $dob=$request->dob;
        $profile=$request->profile;
        //validate form
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',                
            'password_confirmation' => 'required|min:6|max:20|same:password',
            'phone' => 'required|numeric',            
            'dob' => 'required|date',
            'profiel'=>'required',
        ]);
            
        if ($validator->fails()){
            return redirect('register')
            ->withErrors($validator)
            ->withInput();
        }
        User::create([
            'name' => $request->get('name'),
            'email'=> $request->get('email'),
            'password'=> $request->get('password'),
            'phone'=> $request->get('phone'),
            'dob'=> $request->get('dob'),
            'profile'=> $request->get('profile'),
        ]);
    
        return back()->with('success', 'User created successfully.');
            
    }     
}
