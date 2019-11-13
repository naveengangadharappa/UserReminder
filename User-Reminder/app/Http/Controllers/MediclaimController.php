<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Mediclaim;
use App\Http\Requests;
use App\model\map;
use Illuminate\Support\Facades\DB;

class MediclaimController extends Controller
{
    //
    public function index($ids)
    {
        $choices=explode(",",$ids);
        $choice=$choices[1];
        $id=$choices[0];
        switch($choice)
        {
            case "mediclaim":$data=DB::connection('mysql')->select("select * from mediclaims where PolicyNumber=?",[$id]);
            $flg='update';
            $head='Update MediClaim Policy Details';
            return view('Mediclaim',compact('data','flg','head'));
        break;
            case "0":$data="";
            $flg='insert';
            $head='MediClaim Policy Registration';
            return view('Mediclaim',compact('data','flg','head'));
        }
       // return view('VehicleService');
    }

    public function postdata(Request $request)
    {
        if($request->get('choice')=='insert')
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

            Mediclaim::create([
            'email'=>$Email,
            'PolicyNumber' => $request->get('PolicyNumber'),
            'MediclaimCompany'=> $request->get('MediclaimCompany'),
            'DateOfPurchase' => $request->get('DateOfPurchase'),
            'ReminderFrequency' => $request->get('ReminderFrequency'),
            'PremiumAmount' => $request->get('PremiumAmount')
            ]); 
            return redirect('/Mediclaim/,0')->with('success',"Policy Registration successfull"); 
            }
            else{
                $this->validate($request,[
                    'PolicyNumber' => 'required',
                    'MediclaimCompany' => 'required',
                    'DateOfPurchase' => 'required',
                    'ReminderFrequency' => 'required',
                    'PremiumAmount' => 'required',
                ]);
               
                if($request->get('PolicyDocument')=='')
                {
                    echo $request->get('PolicyDocument');
                    $id=$request->get('PolicyNumber');
                    DB::connection('mysql')->select("update mediclaims set MediclaimCompany =?,DateOfPurchase=?,ReminderFrequency=?,PremiumAmount=? where PolicyNumber=?",[$request->get('MediclaimCompany'),$request->get('DateOfPurchase'),$request->get('ReminderFrequency'),$request->get('PremiumAmount'),$id]);  
                }
                else{
                    echo "hii entered";
                    $policynumber=$request->get('PolicyNumber');
                $document=$request->file('PolicyDocument');
                $documentname=$policynumber.".".$document->getClientOriginalExtension();
                /*$docpath=public_path("document\mediclaim")."/".$documentname;
                unlink($docpath);*/
                $document->move(public_path("document\mediclaim"),$documentname);
                }
                return redirect('/Mediclaim/,0')->with('success',"Policy Details updated successfull");  
            }
            
}
}
