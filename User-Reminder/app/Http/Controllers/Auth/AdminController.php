<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;
use App\User;

class AdminController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $redirectTo = '/';
    public function __construct()
    {
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->middleware('guest:admin');
    }

    public function index()
    {
        return view('auth/Adminlogin');
    }
    public function verifiylogin(Request $request)
    {
        $flag=false;
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect()->intended('/dashboard/1');
        }
        else{
            return redirect()->back();
        }
        
        
        /*
        $data=DB::connection('mysql')->select("select * from adminlogin  where email=? and password=?",[$request->get('email'),$request->get('password')]);  
            foreach($data as $values)
            {
                if($values->email==$request->get('email'))
                {
                    $flag=true;
                    echo "login success";
                    return redirect('/dashboard/1')->with('email',$request->get('email'));
                }
                else{
                    echo "login failed";
                break;
                    
                }
            }
            return redirect('/Adminlogin')->with('logerror','Incorrect Login Credentials ');
        */  
    }
}
