<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class displayMedical extends Controller
{
    //
    public function index($emailchoice)
    {
        $arr=explode(',',$emailchoice);
        $choice=$arr[1];
        $email=$arr[0];
        switch($choice)
        {
            case 'mediclaim':$data=DB::connection('mysql')->select("select * from mediclaims where email=?",[$email]);
            $rout='displaymediclaim';
            $flg='Mediclaim';
            $head='MediClaim Details';
            $heading=array('Policy Number','MediClaim Company','Pemium Amount','Reminder Frequency');
            return view($rout,compact('data','flg','heading','head'));
        break;
        case 'lic':$data=DB::connection('mysql')->select("select * from l_i_c_s where email=?",[$email]);
            $rout='displaymediclaim';
            $flg='lic';
            $head='Lic Policy Details';
            $heading=array('Policy Number','Policy holder','Lic Plan','Date Of Purchase','SumAssured Amount','Pemium Amount','Premium Paying Term','Reminder Frequency');
            return view($rout,compact('data','flg','heading','head'));
        break;
        case 'electronics':$data=DB::connection('mysql')->select("select * from electronics where email=?",[$email]);
            $rout='displaymediclaim';
            $flg='electronics';
            $head='Electronics Goods Details';
            $heading=array('Item Name','Item Number','Date Of Purchase','Warrenty Period','Reminder Frequency');
            return view($rout,compact('data','flg','heading','head'));
        break;
        case 'vehicle':$data=DB::connection('mysql')->select("select * from vehicle_services where email=?",[$email]);
            $rout='displaymediclaim';
            $flg='vehicle';
            $head='Vehicle Servicing Details';
            $heading=array('Vehicle Number','Date of Purchase','Service 1 Due Date','Service 2 Due Date','Service 3 Due Date');
            return view($rout,compact('data','flg','heading','head'));
        break;
        case 'child':$data=DB::connection('mysql')->select("select * from children_vaccins c,add_vaccinations v where c.ChildId=v.ChildId and c.email=?",[$email]);
            $rout='displaymediclaim';
            $flg='child';
            $head='Children Vaccination Details';
            $heading=array('Child Name','DOB','Vaccin Name','Vaccin Due Date');
            return view($rout,compact('data','flg','heading','head'));
        break;
        }
        /*$data=DB::connection('mysql')->select("select DateOfPurchase,ReminderFrequency,PolicyNumber,MediclaimCompany from mediclaims where email=?",[$email]);
        $rout='displaymediclaim';
        $flg='Mediclaim';
        return view($rout,compact('data','flg'));*/
        return redirect('/ChildrenVaccin');
    }
    public function deleteuser($ids)
    {
        $arr=explode(",",$ids);
        $choice=$arr[1];
        $id=$arr[0];
        $auth=$arr[2];
        switch($choice)
        {
            case 'mediclaim':$data=DB::connection('mysql')->delete("delete from mediclaims where PolicyNumber=?",[$id]);
           if($auth=='admin'){return redirect('/CustomerManagement/,0');}
           else{return redirect('/Mediclaim/,0');  }  
            break;
            case 'lic':$data=DB::connection('mysql')->delete("delete from l_i_c_s where Policynumber=?",[$id]);
            if($auth=='admin'){return redirect('/CustomerManagement/,0');}
           else{return redirect('/LIC/,0');}
            break;
            case 'electronics':$data=DB::connection('mysql')->delete("delete from electronics where Itemnumber=?",[$id]);
            if($auth=='admin'){return redirect('/CustomerManagement/,0');}
            else{return redirect('/Electronics/,0'); }   
            break;
            case 'vehicle':$data=DB::connection('mysql')->delete("delete from vehicle_services where VehicleNumber=?",[$id]);
            if($auth=='admin'){return redirect('/CustomerManagement/,0');}
           else{return redirect('/VehicleServiceing/,0');}    
            break;
            case 'child':$data=DB::connection('mysql')->delete("delete from add_vaccinations where VaccinationId=?",[$id]);
            if($auth=='admin'){return redirect('/CustomerManagement/,0');}
           else{return redirect('/ChildrenVaccin/,0');}
            //$childid=$arr[2];
            //$data=DB::connection('mysql')->delete("delete from children_vaccins where ChildId=?",[$childid]);
            break;
            case 'user':$data=DB::connection('mysql')->delete("delete from users where email=?",[$id]);
            $data=DB::connection('mysql')->delete("delete from vehicle_services where email=?",[$id]);
            $data=DB::connection('mysql')->delete("delete from electronics where email=?",[$id]);
            $data=DB::connection('mysql')->delete("delete from l_i_c_s where email=?",[$id]);
            $data=DB::connection('mysql')->delete("delete from mediclaims where email=?",[$id]);
            $data=DB::connection('mysql')->delete("delete from children_vaccins where email=?",[$id]);
            return redirect('/CustomerManagement/,0')->with('success',"User Deleted");;
        break;
        }
    }
    public function InactiveUser($email)
    {
        $data=DB::connection('mysql')->update("update users set status='inactive' where email=?",[$email]);
        return redirect('/CustomerManagement/,0')->with('success',"User InActived");
    }
    public function ActiveUser($email)
    {
        $data=DB::connection('mysql')->update("update users set status='active' where email=?",[$email]);
        return redirect('/CustomerManagement/,0')->with('success',"User Actived");
    }
    public function ChangeReminder($email)
    {
        $emailarry=explode(",",$email);
        $id=$emailarry[0];
        $choice=$emailarry[1];
        $data=DB::connection('mysql')->update("update users set Remindertype=? where email=?",[$choice,$id]);
        return redirect('/Mediclaim/,0');
    }
}
