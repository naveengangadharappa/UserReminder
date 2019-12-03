<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\LIC;
use App\Http\Requests;
use App\model\map;
use Illuminate\Support\Facades\DB;
use File;

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
            'DateOfPurchase' => 'required',
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

        LIC::create([
            'email'=>$Email,
            'Policynumber' => $request->get('Policynumber'),
            'PolicyHolder'=> $request->get('PolicyHolder'),
            'LicPlanName' => $request->get('LicPlanName'),
            'DateOfPurchase' => $request->get('DateOfPurchase'),
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
            'DateOfPurchase' => 'required',
            'SumAssuredAmount' => 'required',
            'PremiumAmount' => 'required',
            'PremiumPayingTerm' => 'required',
            'ReminderFrequency' => 'required',
        ]);
        try{
        if($request->hasFile('PolicyDocument'))
        {
            $policynumber=$request->get('Policynumber');
        $document=$request->file('PolicyDocument');
        $documentname=$policynumber.".".$document->getClientOriginalExtension();
            $documentname1=public_path("document\Lic")."/".$policynumber.".jpg";
                $documentname2=public_path("document\Lic")."/".$policynumber.".png";
                $documentname3=public_path("document\Lic")."/".$policynumber.".pdf";
                $filename  = public_path("document\Lic")."/".$documentname;
                $flg=0;
                if(File::exists($documentname1))
                {
                    $flg=1;
                }
                if(File::exists($documentname2))
                {
                    $flg=2;  
                }
                if(File::exists($documentname3))
                {
                    $flg=3; 
                }
                switch($flg)
                {
                    case 1:$filename=$documentname1;
                    break;
                    case 2:$filename=$documentname2;
                    break;
                    case 3:$filename=$documentname3;
                    break;
                }
                File::delete($filename);
                $document->move(public_path("document\Lic"),$documentname);
                $id=$request->get('Policynumber');
                DB::connection('mysql')->select("update l_i_c_s set PolicyHolder =?,LicPlanName=?,DateOfPurchase=?,SumAssuredAmount=?,PremiumAmount=?,PremiumPayingTerm=?,ReminderFrequency=? where Policynumber=?",[$request->get('PolicyHolder'),$request->get('LicPlanName'),$request->get('DateOfPurchase'),$request->get('SumAssuredAmount'),$request->get('PremiumAmount'),$request->get('PremiumPayingTerm'),$request->get('ReminderFrequency'),$id]);  
        }
        else{
            $id=$request->get('Policynumber');
            DB::connection('mysql')->select("update l_i_c_s set PolicyHolder =?,LicPlanName=?,DateOfPurchase=?,SumAssuredAmount=?,PremiumAmount=?,PremiumPayingTerm=?,ReminderFrequency=? where Policynumber=?",[$request->get('PolicyHolder'),$request->get('LicPlanName'),$request->get('DateOfPurchase'),$request->get('SumAssuredAmount'),$request->get('PremiumAmount'),$request->get('PremiumPayingTerm'),$request->get('ReminderFrequency'),$id]);  
        }
        return redirect('/LIC/,0')->with('success',"Policy Details updated successfull");
       } 
    catch(\Exception $e)  
    {
        echo "Exception in LIC = " .$e;
        return redirect('/LIC/,0');
    }
    }
}
}