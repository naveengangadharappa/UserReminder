<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use Illuminate\Support\Facades\DB;
class CustomerManagement extends Controller
{
    public function index($ids)
    {
        $id=explode(',',$ids);
        $name=$id[0];
        $choice=$id[1];
        switch($choice)
        {
        case '0':$data=DB::connection('mysql')->select("select * from users where roles='user'");
        $head='Customers Details';
        return view('Admin/CustomerManagement',compact('data','head')); 
        break;
        case '1':$name='%'.$name.'%';
        $data=DB::connection('mysql')->select("select * from users where roles='user' and name like ?",[$name]);
        $head='Customers Details';
        return view('Admin/CustomerManagement',compact('data','head')); 
        break;
        }
    }
    public function postdata(Request $request)
    {
        $name=$request->get('search');
        $rout="./CustomerManagement/".$name.",1";
        return redirect($rout);
    }
}
