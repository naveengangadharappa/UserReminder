<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class EditProfile extends Controller
{
    //
    public function index($email)
    {
        $data=DB::connection('mysql')->select("select * from users where email=?",[$email]);
        return view('EditProfile',compact('data'));
    }

    public function UpdateProfile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'Mobilenumber' => 'required|min:10|max:13',
        ]);
        DB::connection('mysql')->select("update users set name =?,email=?,Mobilenumber=? where email=?",[$request->get('name'),$request->get('email'),$request->get('Mobilenumber'),$request->get('uemail')]);  
        return redirect('/home');
    }
}
