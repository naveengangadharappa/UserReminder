<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class NavigationOptionController extends Controller
{
    //
    public function index()
    {
        return view('layouts/NavigationOption');
    }
}
