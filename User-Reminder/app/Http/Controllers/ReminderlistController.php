<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ReminderlistController extends Controller
{
    public function index($emailchoice)
    {
        $arr=explode(',',$emailchoice);
        $choice=$arr[1];
        $email=$arr[0];
        switch($choice)
        {
            case 'mediclaim':$data=DB::connection('mysql')->select("select * from mediclaims where email=?",[$email]);
            $rout='Admin/Reminderlist';
            $flg='Mediclaim';
            $head='MediClaim Details';
            $heading=array('Policy Number','MediClaim Company','Pemium Amount','Reminder Frequency');
            return view($rout,compact('data','flg','heading','head','email'));
        break;
        case 'lic':$data=DB::connection('mysql')->select("select * from l_i_c_s where email=?",[$email]);
            $rout='Admin/Reminderlist';
            $flg='lic';
            $head='Lic Policy Details';
            $heading=array('Policy Number','Policy holder','Lic Plan','Date Of Purchase','SumAssured Amount','Pemium Amount','Premium Paying Term','Reminder Frequency');
            return view($rout,compact('data','flg','heading','head','email'));
        break;
        case 'electronics':$data=DB::connection('mysql')->select("select * from electronics where email=?",[$email]);
            $rout='Admin/Reminderlist';
            $flg='electronics';
            $head='Electronics Goods Details';
            $heading=array('Item Name','Item Number','Date Of Purchase','Warrenty Period','Reminder Frequency');
            return view($rout,compact('data','flg','heading','head','email'));
        break;
        case 'vehicle':$data=DB::connection('mysql')->select("select * from vehicle_services where email=?",[$email]);
            $rout='Admin/Reminderlist';
            $flg='vehicle';
            $head='Vehicle Servicing Details';
            $heading=array('Vehicle Number','Date of Purchase','Service 1 Due Date','Service 2 Due Date','Service 3 Due Date');
            return view($rout,compact('data','flg','heading','head','email'));
        break;
        case 'child':$data=DB::connection('mysql')->select("select * from children_vaccins c,add_vaccinations v where c.ChildId=v.ChildId and c.email=?",[$email]);
            $rout='Admin/Reminderlist';
            $flg='child';
            $head='Children Vaccination Details';
            $heading=array('Child Name','DOB','Vaccin Name','Vaccin Due Date');
            return view($rout,compact('data','flg','heading','head','email'));
        break;
        }
    }
}
