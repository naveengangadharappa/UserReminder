<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\model\map;
use Mail;
use Nexmo\Laravel\Facade\Nexmo;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'Mobilenumber' => 'required|min:10|max:13|unique:users',
            'role'=>'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $Email=$data['email'];
        try{
      $mailflg=Mail::send('Registeremail', $data, function($message) use ($data) {
         $message->to($data['email']);
         $message->subject('Esds Customer Reminder Service Registartion');
      });
      Nexmo::message()->send([
        'to'   => '+91 '.$data['Mobilenumber'],
        'from' => '+91 74833 34815 ',
        'text' => 'Esds Customer Reminder Service Registartion process is complete.'
    ]);
    }
      catch(\Exception $e)
    {
        echo "Please Provide Valid Email Address and Mobile Number " ;
        return Validator::make($data, [
        ]);
    }
       return User::create([
      'name' => $data['name'],
      'Mobilenumber' => $data['Mobilenumber'],
      'email' => $data['email'],
      'roles'=>$data['role'],
      'status'=>'active',
      'Remindertype'=>'sms',
      'password' => bcrypt($data['password']),
  ]);
    }
}
