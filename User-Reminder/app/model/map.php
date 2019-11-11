<?php

namespace App\model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class map extends Model
{
    public function insert($Email,$MediClaimPolicyNumber,$LicPolicyNumber,$VehicleNumber,$ItemNumber,$ChildId)
    {
        DB::connection('mysql')->insert("insert into mapping(Email,MediClaimPolicyNumber,LicPolicyNumber,VehicleNumber,ItemNumber,ChildId) values(?,?,?,?,?,?)",
        [$Email,$MediClaimPolicyNumber,$LicPolicyNumber,$VehicleNumber,$ItemNumber,$ChildId]);
    }
    public function getChildNames($Email)
    {
        $childdetails=array();
        $mappingdata=DB::connection('mysql')->select("select ChildId,ChildName from children_vaccins where Email=?",[$Email]);
        $i=0;
        foreach($mappingdata as $values)
            {
                $childdetails[$i++]= $values->ChildName.','.$values->ChildId;   
            }
            return $childdetails;
    }
    public function testReminder()
    {
        $data=DB::connection('mysql')->select("select DateOfPurchase,ReminderFrequency,PolicyNumber,MediclaimCompany,email from mediclaims");
        $Policyno=array();
        $cnt=0;
        $emailarray=array();
        $mediclaimcompany=array();
        $emailsubject='';
        $emailmsg='';
        foreach($data as $values)
            {
                $date1A = date("d-m-Y");
                $date1 = date_create($date1A);
                $date2 = date_create($values->DateOfPurchase);
                $intverl=date_diff($date1,$date2);
                $c=$intverl->format("%a");
                if(365-$c==$values->ReminderFrequency)
                {
                     $policyno[$cnt]=$values->PolicyNumber;
                     $emailarray[$cnt]=$values->email;
                     $mediclaimcompany[$cnt]=$values->MediclaimCompany;
                     $cnt++;
                }
            }
            for($i=0;$i<count($policyno);$i++)
            {
                echo $emailarray[$i];
                echo $mediclaimcompany[$i];
                echo $policyno[$i];
                //mailing code;
            }
    }
}
