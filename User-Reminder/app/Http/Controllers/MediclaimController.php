<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Mediclaim;
use App\Http\Requests;
use App\model\map;
use Illuminate\Support\Facades\DB;
use File;

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
        try{
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
            catch(\Exception $e)  
            {
                echo "Exception in MediClaim = " .$e;
                return redirect('/Mediclaim/,0');
            }
        }
            else{
                $this->validate($request,[
                    'PolicyNumber' => 'required',
                    'MediclaimCompany' => 'required',
                    'DateOfPurchase' => 'required',
                    'ReminderFrequency' => 'required',
                    'PremiumAmount' => 'required',
                ]);
               try{
                if($request->hasFile('PolicyDocument'))
                {
                $policynumber=$request->get('PolicyNumber');
                $document=$request->file('PolicyDocument');
                $documentname=$policynumber.".".$document->getClientOriginalExtension();
                $documentname1=public_path("document\mediclaim")."/".$policynumber.".jpg";
                $documentname2=public_path("document\mediclaim")."/".$policynumber.".png";
                $documentname3=public_path("document\mediclaim")."/".$policynumber.".pdf";
                $filename  = public_path("document\mediclaim")."/".$documentname;
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
                        $document->move(public_path("document\mediclaim"),$documentname);
                        $id=$request->get('PolicyNumber');
                        DB::connection('mysql')->select("update mediclaims set MediclaimCompany =?,DateOfPurchase=?,ReminderFrequency=?,PremiumAmount=? where PolicyNumber=?",[$request->get('MediclaimCompany'),$request->get('DateOfPurchase'),$request->get('ReminderFrequency'),$request->get('PremiumAmount'),$id]); 
                }
                else{
                    $id=$request->get('PolicyNumber');
                    DB::connection('mysql')->select("update mediclaims set MediclaimCompany =?,DateOfPurchase=?,ReminderFrequency=?,PremiumAmount=? where PolicyNumber=?",[$request->get('MediclaimCompany'),$request->get('DateOfPurchase'),$request->get('ReminderFrequency'),$request->get('PremiumAmount'),$id]);  
                }
                    return redirect('/Mediclaim/,0')->with('success',"Policy Details updated successfull");    
            }
            catch(\Exception $e)  
            {
                echo "Exception in MediClaim = " .$e;
                return redirect('/Mediclaim/,0');
            }
        }
       
            
}
}
