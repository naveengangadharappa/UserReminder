<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\LIC;
use App\Http\Requests;
use App\model\map;
use Illuminate\Support\Facades\DB;

class LICController extends Controller
{
    //
    public function index($ids)
    {
        $choices=explode(",",$ids);
        $choice=$choices[1];
        $id=$choices[0];
        switch($choice)
        {
            case "lic":$data=DB::connection('mysql')->select("select * from l_i_c_s where Policynumber=?",[$id]);
            $flg='update';
            $head='Update LIC Policy Details';
            return view('Lic',compact('data','flg','head'));
        break;
            case "0":$data="";
            $flg='insert';
            $head='LIC Policy Registration';
            return view('Lic',compact('data','flg','head'));
        }
       // return view('Lic');
    }

    public function postdata(Request $request)
    {
        if($request->get('choice')=='insert')
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
        /*$choice="Lic";
        $map=new map();
        echo $Email;
        $map->updatemap($Email,$choice,$mapdata);*/

        LIC::create([
            'email'=>$Email,
            'Policynumber' => $request->get('Policynumber'),
            'PolicyHolder'=> $request->get('PolicyHolder'),
            'LicPlanName' => $request->get('LicPlanName'),
            'SumAssuredAmount' => $request->get('SumAssuredAmount'),
            'PremiumAmount' => $request->get('PremiumAmount'),
            'PremiumPayingTerm' => $request->get('PremiumPayingTerm'),
            'ReminderFrequency' => $request->get( 'ReminderFrequency')
        ]); 
        return redirect('/LIC/,0')->with('success',"Policy Details Registered successfull");
       }
       else{
        $this->validate($request,[
            'Policynumber' => 'required',
            'PolicyHolder' => 'required',
            'LicPlanName' => 'required',
            'SumAssuredAmount' => 'required',
            'PremiumAmount' => 'required',
            'PremiumPayingTerm' => 'required',
            'ReminderFrequency' => 'required',
        ]);
        if($request->get('PolicyDocument')=='')
        {
            echo $request->get('PolicyDocument');
            $id=$request->get('Policynumber');
            DB::connection('mysql')->select("update l_i_c_s set PolicyHolder =?,LicPlanName=?,SumAssuredAmount=?,PremiumAmount=?,PremiumPayingTerm=?,ReminderFrequency=? where Policynumber=?",[$request->get('PolicyHolder'),$request->get('LicPlanName'),$request->get('SumAssuredAmount'),$request->get('PremiumAmount'),$request->get('PremiumPayingTerm'),$request->get('ReminderFrequency'),$id]);  
        }
        else{
            $policynumber=$request->get('Policynumber');
        $document=$request->file('PolicyDocument');
        $documentname=$policynumber.".".$document->getClientOriginalExtension();
        /*$docpath=public_path("document\mediclaim")."/".$documentname;
        unlink($docpath);*/
        $document->move(public_path("document\Lic"),$documentname);
        }
        return redirect('/LIC/,0')->with('success',"Policy Details updated successfull");
       } 
       
    }
}