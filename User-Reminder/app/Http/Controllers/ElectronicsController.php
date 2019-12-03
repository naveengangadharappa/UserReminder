<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Electronics;
use App\model\map;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use File;

class ElectronicsController extends Controller
{
    //
    public function index($ids)
    {
        $choices=explode(",",$ids);
        $choice=$choices[1];
        $id=$choices[0];
        switch($choice)
        {
            case "electronics":$data=DB::connection('mysql')->select("select * from electronics where Itemnumber=?",[$id]);
            $flg='update';
            $head='Update Electronic Goods Details';
            return view('ElectronicGoods',compact('data','flg','head'));
        break;
            case "0":$data="";
            $flg='insert';
            $head='Electronic Goods Registration';
            return view('ElectronicGoods',compact('data','flg','head'));
        }
    }

    public function postdata(Request $request)
    {
        if($request->get('choice')=='insert')
       { 
        $this->validate($request,[
            'ItemName' => 'required',
            'Itemnumber' => 'required|unique:electronics',
            'DateOfPurchase' => 'required',
            'ReminderFrequency' => 'required',
            'WarrantyPeriod' => 'required',
            'UploadBills'=> 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            'WarrantyCard'=> 'required|mimes:jpeg,jpg,png,pdf|max:2048',
        ]);

        $policynumber=$request->get('Itemnumber');
        $documentbill=$request->file('UploadBills');
        $documentnamebill=$policynumber.".".$documentbill->getClientOriginalExtension();
        $documentbill->move(public_path("document\Electronics\bills"),$documentnamebill);
        
        $documentwarrenty=$request->file('WarrantyCard');
        $documentnamewarrenty=$policynumber.".".$documentwarrenty->getClientOriginalExtension();
        $documentwarrenty->move(public_path("document\Electronics\warrenty"),$documentnamewarrenty);


        $Email=$request->get('email');
        $mapdata=$request->get('Itemnumber');
        
        Electronics::create([
            'email'=>$Email,
            'ItemName' => $request->get('ItemName'),
            'Itemnumber'=> $request->get('Itemnumber'),
            'DateOfPurchase'=> $request->get('DateOfPurchase'),
            'ReminderFrequency' => $request->get('ReminderFrequency'),
            'WarrantyPeriod' => $request->get('WarrantyPeriod')
        ]);
        return redirect('/Electronics/,0')->with('success',"Registration successfull");
       }
       else{
        $this->validate($request,[
            'ItemName' => 'required',
            'Itemnumber' => 'required',
            'DateOfPurchase' => 'required',
            'ReminderFrequency' => 'required',
            'WarrantyPeriod' => 'required',
        ]);
        try{
            $choice="";
            if($request->hasFile('UploadBills'))
            {
                $choice="UploadBills";
            }
            if($request->hasFile('WarrantyCard'))
            {
                $choice="WarrantyCard";
            }
            if($request->hasFile('WarrantyCard') && $request->hasFile('UploadBills') )
            {
                $choice="both";
            }
            switch($choice)
            {
                case "UploadBills":
                        $policynumber=$request->get('Itemnumber');
                        $documentbill=$request->file('UploadBills');
                        $documentnamebill=$policynumber.".".$documentbill->getClientOriginalExtension();
                        $documentname1=public_path("document\Electronics\bills")."/".$policynumber.".jpg";
                        $documentname2=public_path("document\Electronics\bills")."/".$policynumber.".png";
                        $documentname3=public_path("document\Electronics\bills")."/".$policynumber.".pdf";
                        $filename  = '';
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
                                $documentbill->move(public_path("document\Electronics\bills"),$documentnamebill);
                break;
                case "WarrantyCard":
                        $policynumber=$request->get('Itemnumber');
                        $documentwarrenty=$request->file('WarrantyCard');
                        $documentnamewarrenty=$policynumber.".".$documentwarrenty->getClientOriginalExtension();
                        $documentname1=public_path("document\Electronics\warrenty")."/".$policynumber.".jpg";
                        $documentname2=public_path("document\Electronics\warrenty")."/".$policynumber.".png";
                        $documentname3=public_path("document\Electronics\warrenty")."/".$policynumber.".pdf";
                        $filename  = '';
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
                                $documentwarrenty->move(public_path("document\Electronics\warrenty"),$documentnamewarrenty);        
                break;
                case "both":
                    $policynumber=$request->get('Itemnumber');
                    $documentbill=$request->file('UploadBills');
                    $documentnamebill=$policynumber.".".$documentbill->getClientOriginalExtension();
                    $documentname1=public_path("document\Electronics\bills")."/".$policynumber.".jpg";
                    $documentname2=public_path("document\Electronics\bills")."/".$policynumber.".png";
                    $documentname3=public_path("document\Electronics\bills")."/".$policynumber.".pdf";
                    $filename  = '';
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
                            $documentbill->move(public_path("document\Electronics\bills"),$documentnamebill);
                
                            $policynumber=$request->get('Itemnumber');
                            $documentwarrenty=$request->file('WarrantyCard');
                            $documentnamewarrenty=$policynumber.".".$documentwarrenty->getClientOriginalExtension();
                            $documentname1=public_path("document\Electronics\warrenty")."/".$policynumber.".jpg";
                            $documentname2=public_path("document\Electronics\warrenty")."/".$policynumber.".png";
                            $documentname3=public_path("document\Electronics\warrenty")."/".$policynumber.".pdf";
                            $filename  = '';
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
                                    $documentwarrenty->move(public_path("document\Electronics\warrenty"),$documentnamewarrenty);                
                break;
            }
            $id=$request->get('Itemnumber');
            DB::connection('mysql')->select("update electronics set ItemName =?,DateOfPurchase=?,ReminderFrequency=?,WarrantyPeriod=? where Itemnumber=?",[$request->get('ItemName'),$request->get('DateOfPurchase'),$request->get('ReminderFrequency'),$request->get('WarrantyPeriod'),$id]);  
            return redirect('/Electronics/,0')->with('success',"Updation successfull");
        }
        catch(Exception $e)  
        {
        echo "Exception in MediClaim = " .$e;
        return redirect('/Electronics/,0');
        }  
       
       }
    }
}
