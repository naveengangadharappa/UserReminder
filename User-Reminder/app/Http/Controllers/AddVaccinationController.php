<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AddVaccinationController extends Controller
{
    //
    public function index()
    {
        return view('AddVaccination');
    }

    public function postdata(Request $request)
    {
        $this->validate($request,[
            'PolicyNumber' => 'required',
            'MediclaimCompany' => 'required',
            'DateOfPurchase' => 'required',
            'ReminderFrequency' => 'required',
            'PremiumAmount' => 'required',
            'PolicyDocument'=> 'required',
        ]);
}
}