<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\ChildrenVaccin;

use App\Http\Requests;
use App\model\map;
use Illuminate\Support\Facades\DB;

class ChildrenVaccinController extends Controller
{
    //
    public function index($ids)
    {
        $choices=explode(",",$ids);
        $choice=$choices[1];
        $id=$choices[0];
        switch($choice)
        {
            case "child":$data=DB::connection('mysql')->select("select * from children_vaccins c,add_vaccinations a where a.ChildId=c.ChildId and a.VaccinationId=?",[$id]);
            $flg='update';
            $head='Update Children Vaccination Details';
            return view('ChildrenVaccin',compact('data','flg','head'));
        break;
            case "0":$data="";
            $flg='insert';
            $head='Register Children Details';
            return view('ChildrenVaccin',compact('data','flg','head'));
        }
        //return view('ChildrenVaccin');
    }

    public function postdata(Request $request)
    {
        if($request->get('choice')=='insert')
       { 
        $this->validate($request,[
            'ChildName' => 'required',
            'DateOfBirth' => 'required',
        ]);
        
        $ChildId=(random_int(10,9999976)-random_int(10,4000091))/3;
        $Email=$request->get('email');

        ChildrenVaccin::create([
            'email'=>$Email,
            'ChildId' =>$ChildId,
            'ChildName' => $request->get('ChildName'),
            'DateOfBirth'=> $request->get('DateOfBirth')
        ]);
        return redirect('/ChildrenVaccin/,0')->with('success',"Registration successfull");
       }
       else{
        $this->validate($request,[
            'ChildName' => 'required',
            'DateOfBirth' => 'required',
            'VaccinationName' => 'required',
            'VaccinationDuedate' => 'required',
            
        ]);
        $id=$request->get('PolicyNumber');
        DB::connection('mysql')->select("update children_vaccins set ChildName =?,DateOfBirth=? where ChildId=?",[$request->get('ChildName'),$request->get('DateOfBirth'),$request->get('ChildId')]);
        DB::connection('mysql')->select("update add_vaccinations set VaccinationName =?,VaccinationDuedate=? where VaccinationId=?",[$request->get('VaccinationName'),$request->get('VaccinationDuedate'),$request->get('VaccinId')]);  
        return redirect('/ChildrenVaccin/,0')->with('success',"updatadion successfull");  
    }
       
    }
}