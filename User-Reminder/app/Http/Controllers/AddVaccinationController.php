<?php

namespace App\Http\Controllers;
use App\AddVaccination;
use Illuminate\Http\Request;
use App\model\map;
use App\Http\Requests;

class AddVaccinationController extends Controller
{
    //
    public function index()
    {
        return view('AddVaccination');
    }

    public function getchild(Request $request)
    {
        //$Email=$request->get('email');
        //$Email=$data->email;
        $Email="gnaveenkumar18.ng@gmail.com";
        $map=new map();
        $childNames=array();
        $childdetails=array();
        $childdetails=$map->getChildNames($Email);
        $i=0;
        $childs='';
        foreach($childdetails as $val)
        {
            $data=explode(',',$val);
            $childs=$childs.$data[0].','.$data[1].',';

        }
        echo json_encode($childs);
    }

    public function postdata(Request $request)
    {
        $this->validate($request,[
            'ChildName'=>'required',
            'VaccinationName' => 'required',
            'VaccinationDuedate' => 'required',
        ]);
        
        $ChildId=$request->get('ChildName');
        $VaccinationId=(random_int(10,99999999)-random_int(10,33339999))/3;
        $Email=$request->get('email');
        $map=new map();
        $map->insertvaccinmap($Email,$ChildId,$VaccinationId);

        AddVaccination::create([
            'VaccinationId' =>$VaccinationId,
            'VaccinationName' => $request->get('VaccinationName'),
            'VaccinationDuedate'=> $request->get('VaccinationDuedate'),
        ]);
        return redirect('/AddVaccination');
    }
}