<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Electronics;
use App\model\map;
use App\Http\Requests;

class ElectronicsController extends Controller
{
    //
    public function index()
    {
        return view('ElectronicGoods');
    }

    public function postdata(Request $request)
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
        $choice="item";
        $map=new map();
        $map->updatemap($Email,$choice,$mapdata);

        Electronics::create([
            'ItemName' => $request->get('ItemName'),
            'Itemnumber'=> $request->get('Itemnumber'),
            'DateOfPurchase'=> $request->get('DateOfPurchase'),
            'ReminderFrequency' => $request->get('ReminderFrequency'),
            'WarrantyPeriod' => $request->get('WarrantyPeriod')
        ]);
        return redirect('/Electronics');
    }
}
