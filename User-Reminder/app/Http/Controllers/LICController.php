<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\LIC;
use App\Http\Requests;
use App\model\map;

class LICController extends Controller
{
    //
    public function index()
    {
        return view('Lic');
    }

    public function postdata(Request $request)
    {
        $this->validate($request,[
            'Policynumber' => 'required|unique:l_i_c_s',
            'PolicyHolder' => 'required',
            'LicPlanName' => 'required',
            'SumAssuredAmount' => 'required',
            'PremiumAmount' => 'required',
            'PremiumPayingTerm' => 'required',
            'ReminderFrequency' => 'required',
            'PolicyDocument'=> 'required|mimes:jpeg,jpg,png,pdf|max:2048',
        ]);

        $policynumber=$request->get('Policynumber');
        $document=$request->file('PolicyDocument');
        $documentname=$policynumber.".".$document->getClientOriginalExtension();
        $document->move(public_path("document\Lic"),$documentname);

        $Email=$request->get('email');
        $mapdata=$request->get('Policynumber');
        $choice="Lic";
        $map=new map();
        echo $Email;
        $map->updatemap($Email,$choice,$mapdata);

        LIC::create([
            'Policynumber' => $request->get('Policynumber'),
            'PolicyHolder'=> $request->get('PolicyHolder'),
            'LicPlanName' => $request->get('LicPlanName'),
            'SumAssuredAmount' => $request->get('SumAssuredAmount'),
            'PremiumAmount' => $request->get('PremiumAmount'),
            'PremiumPayingTerm' => $request->get('PremiumPayingTerm'),
            'ReminderFrequency' => $request->get( 'ReminderFrequency')
        ]);  
        return redirect('/LIC');
    }
}