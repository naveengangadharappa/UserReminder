<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\VehicleService;
use App\Http\Requests;
use App\model\map;

class VehicleServiceController extends Controller
{
    public function index()
    {
        return view('VehicleService');
    }

    public function postdata(Request $request)
    {
        $this->validate($request,[
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
        $choice="vehicle";
        $map=new map();
        $map->updatemap($Email,$choice,$mapdata);

        VehicleService::create([
            'VehicleType' => $request->get('VehicleType'),
            'VehicleNumber'=> $request->get('VehicleNumber'),
            'DateOfPurchase'=> $request->get('DateOfPurchase'),
            'Servicing1DueDate' => $request->get('Servicing1DueDate'),
            'Servicing1DueDate' => $request->get('Servicing1DueDate'),
            'Servicing1DueDate' => $request->get('Servicing1DueDate'),
            'PUCExpirydate' => $request->get( 'PUCExpirydate')
        ]);

        return redirect('/VehicleService');
}
}