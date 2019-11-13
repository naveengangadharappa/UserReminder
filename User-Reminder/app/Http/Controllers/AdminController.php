<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
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
    }
}
