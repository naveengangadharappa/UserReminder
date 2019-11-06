<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\ChildrenVaccin;

use App\Http\Requests;
use App\model\map;

class ChildrenVaccinController extends Controller
{
    //
    public function index()
    {
        return view('ChildrenVaccin');
    }

    public function postdata(Request $request)
    {
        $this->validate($request,[
            'ChildName' => 'required',
            'DateOfBirth' => 'required',
        ]);
        
        $mapdata=system('date +%s%N');
        $Email=$request->get('email');
        $choice="child";
        $map=new map();
        $map->updatemap($Email,$choice,$mapdata);

        ChildrenVaccin::create([
            'ChildId' =>$mapdata,
            'ChildName' => $request->get('ChildName'),
            'DateOfBirth'=> $request->get('DateOfBirth')
        ]);
        return redirect('/Electronics');
    }
}