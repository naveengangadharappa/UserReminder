<?php

namespace App\Http\Controllers;
use App\AddVaccination;
use Illuminate\Http\Request;
use App\model\map;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class AddVaccinationController extends Controller
{
    //
    public function index($Email)
    {
        $data=DB::connection('mysql')->select("select ChildId,ChildName from children_vaccins where Email=?",[$Email]);
        return view('AddVaccination',compact('data'));
    }

    public function callreminder()
    {
        $map=new map();
        $date=$map->testReminder();
        echo $date;
    }
    public function getchild($email)
    {
        $Email=$email;
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
        try{
            
        $this->validate($request,[
            'ChildName'=>'required',
            'VaccinationName' => 'required',
            'VaccinationDuedate' => 'required',
        ]);
        
        $VaccinationId=(random_int(10,99999999)-random_int(10,33339999))/3;
        AddVaccination::create([
            'ChildId'=>$request->get('ChildName'),
            'VaccinationId' =>$VaccinationId,
            'VaccinationName' => $request->get('VaccinationName'),
            'VaccinationDuedate'=> $request->get('VaccinationDuedate'),
        ]);
        return redirect('/ChildrenVaccin/,0')->with('success',"Vaccination Registered successfull");
    }
    catch(Exception $e)  
{
echo "Exception in Add Vaccination = " .$e;
return redirect('/ChildrenVaccin/,0');
}
    }
}