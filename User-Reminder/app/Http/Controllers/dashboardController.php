<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class dashboardController extends Controller
{
    //
    public function index($status)
    {
        switch($status)
        {
            case 1:return view('Admin/dashboard');
            break;
            case 0:return view('auth/login');
            break;
        }
        
    }
}
