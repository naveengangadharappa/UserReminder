<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Electronics;
use App\model\map;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

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
       // return view('ElectronicGoods');
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
        /*$choice="item";
        $map=new map();
        $map->updatemap($Email,$choice,$mapdata);*/

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
        if($request->get('UploadBills')=='' and $request->get('WarrantyCard')=='')
        {
            echo $request->get('UploadBills');
            $id=$request->get('Itemnumber');
            DB::connection('mysql')->select("update electronics set ItemName =?,DateOfPurchase=?,ReminderFrequency=?,WarrantyPeriod=? where Itemnumber=?",[$request->get('ItemName'),$request->get('DateOfPurchase'),$request->get('ReminderFrequency'),$request->get('WarrantyPeriod'),$id]);  
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
        return redirect('/Electronics/,0')->with('success',"Updation successfull");
       }
        
    }
}
