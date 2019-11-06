<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Mediclaim;
use App\Http\Requests;
use App\model\map;

class MediclaimController extends Controller
{
    //
    public function index()
    {
        return view('Mediclaim');
    }

    public function postdata(Request $request)
    {
        $this->validate($request,[
            'PolicyNumber' => 'required|unique:mediclaims',
            'MediclaimCompany' => 'required',
            'DateOfPurchase' => 'required',
            'ReminderFrequency' => 'required',
            'PremiumAmount' => 'required',
            'PolicyDocument'=> 'required|mimes:jpeg,jpg,png,pdf|max:2048',
        ]);
        $policynumber=$request->get('PolicyNumber');
        $document=$request->file('PolicyDocument');
        $documentname=$policynumber.".".$document->getClientOriginalExtension();
        $document->move(public_path("document\mediclaim"),$documentname);

        $Email=$request->get('email');
        $mapdata=$request->get('PolicyNumber');
        $choice="medical";
        $map=new map();
        $map->updatemap($Email,$choice,$mapdata);

            Mediclaim::create([
            'PolicyNumber' => $request->get('PolicyNumber'),
            'MediclaimCompany'=> $request->get('MediclaimCompany'),
            'DateOfPurchase' => $request->get('DateOfPurchase'),
            'ReminderFrequency' => $request->get('ReminderFrequency'),
            'PremiumAmount' => $request->get('PremiumAmount')
            ]);  

            return redirect('/Mediclaim');
}
}
