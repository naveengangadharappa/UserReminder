<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;
use Illuminate\Support\Facades\DB;
class CustomerManagement extends Controller
{
    public function index()
    {
        $data=DB::connection('mysql')->select("select * from users");
        $head='Customers Details';
        return view('Admin/CustomerManagement',compact('data','head')); 
    }
}
