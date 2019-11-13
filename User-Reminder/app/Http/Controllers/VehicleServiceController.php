<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\VehicleService;
use App\Http\Requests;
use App\model\map;
use Illuminate\Support\Facades\DB;

class VehicleServiceController extends Controller
{
    public function index($ids)
    {
        $choices=explode(",",$ids);
        $choice=$choices[1];
        $id=$choices[0];
        switch($choice)
        {
            case "vehicle":$data=DB::connection('mysql')->select("select * from vehicle_services where VehicleNumber=?",[$id]);
            $flg='update';
            $head='Update Vehicle Servicing Details';
            return view('VehicleService',compact('data','flg','head'));
        break;
            case "0":$data="";
            $flg='insert';
            $head='Vehicle Servicing Registration';
            return view('VehicleService',compact('data','flg','head'));
        }
       // return view('VehicleService');
    }

    public function postdata(Request $request)
    {
        if($request->get('choice')=='insert')
       { $this->validate($request,[
            'VehicleType' => 'required',
            'VehicleNumber' => 'required|unique:vehicle_services',
            'DateOfPurchase' => 'required',
            'Servicing1DueDate' => 'required',
            'Servicing2DueDate' => 'required',
            'Servicing3DueDate' => 'required',
            'PUCExpirydate' => 'required',
        ]);

        $Email=$request->get('email');
        $mapdata=$request->get('VehicleNumber');
        /*$choice="vehicle";
        $map=new map();
        $map->updatemap($Email,$choice,$mapdata);*/

        VehicleService::create([
            'email'=>$Email,
            'VehicleType' => $request->get('VehicleType'),
            'VehicleNumber'=> $request->get('VehicleNumber'),
            'DateOfPurchase'=> $request->get('DateOfPurchase'),
            'Servicing1DueDate' => $request->get('Servicing1DueDate'),
            'Servicing2DueDate' => $request->get('Servicing2DueDate'),
            'Servicing3DueDate' => $request->get('Servicing3DueDate'),
            'PUCExpirydate' => $request->get( 'PUCExpirydate')
        ]);
        return redirect('/VehicleServiceing/,0')->with('success',"Registration successfull");
       }
       else{
        $this->validate($request,[
            'VehicleType' => 'required',
            'VehicleNumber' => 'required',
            'DateOfPurchase' => 'required',
            'Servicing1DueDate' => 'required',
            'Servicing2DueDate' => 'required',
            'Servicing3DueDate' => 'required',
            'PUCExpirydate' => 'required',
        ]);
        $id=$request->get('VehicleNumber');
        DB::connection('mysql')->select("update vehicle_services set VehicleType =?,DateOfPurchase=?,Servicing1DueDate=?,Servicing2DueDate=?,Servicing3DueDate=?,PUCExpirydate=? where VehicleNumber=?",[$request->get('VehicleType'),$request->get('DateOfPurchase'),$request->get('Servicing1DueDate'),$request->get('Servicing2DueDate'),$request->get('Servicing3DueDate'),$request->get( 'PUCExpirydate'),$id]);  
        return redirect('/VehicleServiceing/,0')->with('success',"updatadion successfull");  
    }
}     
}