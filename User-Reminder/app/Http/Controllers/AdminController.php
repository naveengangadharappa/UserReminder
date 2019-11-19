<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
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

        /*if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect()->intended('/dashboard/1');
        }
        else{
            return redirect()->back();
        }
        
        
        */
        $data=DB::connection('mysql')->select("select * from adminlogins  where email=? and password=?",[$request->get('email'),$request->get('password')]);  
            foreach($data as $values)
            {
                if($values->email==$request->get('email'))
                {
                    echo "login success";
                    return redirect('/dashboard/1')->with('email',$request->get('email'));
                }
                else{
                    echo "login failed";
                break;
                    
                }
            }
            return redirect('/Adminlogin')->with('logerror','Incorrect Login Credentials ');
         }
}
