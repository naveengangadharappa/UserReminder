<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ViewCustomerController extends Controller
{
    //
    public function index($email)
    {
        $Email=$email;
        $medicaldata=DB::connection('mysql')->select("select count(*) as numbers from mediclaims where email=?",[$email]);
        $electronicsdata=DB::connection('mysql')->select("select count(*) as numbers from electronics where email=?",[$email]);
        $licdata=DB::connection('mysql')->select("select count(*) as numbers from l_i_c_s where email=?",[$email]);
        $vehicledata=DB::connection('mysql')->select("select count(*) as numbers from vehicle_services where email=?",[$email]);
        $vaccindata=DB::connection('mysql')->select("select count(*) as numbers from children_vaccins c, add_vaccinations a where c.ChildId=a.ChildId and c.email=?",[$email]);
        return view('Admin/ViewCustomer',compact('medicaldata','electronicsdata','licdata','vehicledata','vaccindata','Email'));
    }
}
