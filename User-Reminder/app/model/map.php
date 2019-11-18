<?php

namespace App\model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Mail;

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
        $map=new map();
        $map->MediclaimReminder();
        //$map->licReminder();
       // $map->vehicleReminder();
       $map->electronicsReminder();
       // $map->vaccinReminder();
    }
    public function MediclaimReminder()
    {
        $data=DB::connection('mysql')->select("select DateOfPurchase,ReminderFrequency,PolicyNumber,MediclaimCompany,email from mediclaims");
        $policyno=array();
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
                echo $c."\n";
                //if(($c+365)-365==$values->ReminderFrequency)
                if((365-$c)==$values->ReminderFrequency)
                {
                    echo "entered";
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
                $email=array('email'=>$emailarray[$i],'company'=>$mediclaimcompany[$i],'policy'=>$policyno[$i]);
                Mail::send([],$email, function ($message) use ($email)  {
                    $message->to($email['email']);
                    $message->subject("Reminder");
                    $message->setBody('Hi, Goodmorning these is a reminder regarding MedicalClaim, Your MedicalClaim policy with policy number: '.$email['policy'].' and Medicalim company : '.$email['company'].'  is get expired please renew it');                 
                 });
            }
            echo "completed";
    }
    public function electronicsReminder()
    {
        $data=DB::connection('mysql')->select("select DateOfPurchase,ReminderFrequency,ItemNumber,ItemName,email from electronics");
        $Itemno=array();
        $cnt=0;
        $emailarray=array();
        $Itemname=array();
        $emailsubject='';
        $emailmsg='';
        foreach($data as $values)
            {
                $date1A = date("d-m-Y");
                $date1 = date_create($date1A);
                $date2 = date_create($values->DateOfPurchase);
                $intverl=date_diff($date1,$date2);
                $c=$intverl->format("%a");
                echo $c."\n";
                //if(($c+365)-365==$values->ReminderFrequency)
                if((365-$c)==$values->ReminderFrequency)
                {
                    echo "entered";
                     $Itemno[$cnt]=$values->ItemNumber;
                     $emailarray[$cnt]=$values->email;
                     $Itemname[$cnt]=$values->ItemName;
                     $cnt++;
                }
            }
        for($i=0;$i<count($Itemno);$i++)
            {
                echo $emailarray[$i];
                echo $Itemname[$i];
                echo $Itemno[$i];
                $email=array('email'=>$emailarray[$i],'ItemName'=>$Itemname[$i],'ItemNumber'=>$Itemno[$i]);
                Mail::send([],$email, function ($message) use ($email)  {
                    $message->to($email['email']);
                    $message->subject("Reminder");
                    $message->setBody('Hi, Goodmorning these is a reminder regarding Electronic Item Warrenty, Your Electronic item with Item number: '.$email['ItemNumber'].' and Item Name : '.$email['ItemName'].'  is getting expired .');                 
                 });
            }
            echo "completed";
    }
    public function vehicleReminder()
    {
        $data=DB::connection('mysql')->select("select DateOfPurchase,ReminderFrequency,PolicyNumber,MediclaimCompany,email from mediclaims");
        $vehicleno=array();
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
                echo $c."\n";
                //if(($c+365)-365==$values->ReminderFrequency)
                if((365-$c)==$values->ReminderFrequency)
                {
                    echo "entered";
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
                echo $vehicleno[$i];
                $email=array('email'=>$emailarray[$i],'company'=>$mediclaimcompany[$i],'policy'=>$vehicleno[$i]);
                Mail::send([],$email, function ($message) use ($email)  {
                    $message->to($email['email']);
                    $message->subject("Reminder");
                    $message->setBody('Hi, Goodmorning these is a reminder regarding vehicle service, Your MedicalClaim policy with policy number: '.$email['policy'].' and Medicalim company : '.$email['company'].'  is get expired please renew it');                 
                 });
            }
            echo "completed";
    }
    public function licReminder()
    {
        $data=DB::connection('mysql')->select("select DateOfPurchase,ReminderFrequency,PolicyNumber,email from l_i_c_s");
        $policyno=array();
        $cnt=0;
        $emailarray=array();
        $emailsubject='';
        $emailmsg='';
        foreach($data as $values)
            {
                $date1A = date("d-m-Y");
                $date1 = date_create($date1A);
                $date2 = date_create($values->DateOfPurchase);
                $intverl=date_diff($date1,$date2);
                $c=$intverl->format("%a");
                echo $c."\n";
                //if(($c+365)-365==$values->ReminderFrequency)
                if((365-$c)==$values->ReminderFrequency)
                {
                    echo "entered";
                     $policyno[$cnt]=$values->PolicyNumber;
                     $emailarray[$cnt]=$values->email;
                     $cnt++;
                }
            }
        for($i=0;$i<count($policyno);$i++)
            {
                echo $emailarray[$i];
                echo $policyno[$i];
                $email=array('email'=>$emailarray[$i],'policy'=>$policyno[$i]);
                Mail::send([],$email, function ($message) use ($email)  {
                    $message->to($email['email']);
                    $message->subject("Reminder");
                    $message->setBody('Hi, Good Morning these is a reminder regarding MedicalClaim, Your MedicalClaim policy with policy number: '.$email['policy'].' and Medicalim company : '.$email['company'].'  is get expired please renew it');                 
                 });
            }
            echo "completed";
    }
    public function vaccinReminder()
    {
        $data=DB::connection('mysql')->select("select DateOfPurchase,ReminderFrequency,PolicyNumber,MediclaimCompany,email from mediclaims");
        $policyno=array();
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
                echo $c."\n";
                //if(($c+365)-365==$values->ReminderFrequency)
                if((365-$c)==$values->ReminderFrequency)
                {
                    echo "entered";
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
                $email=array('email'=>$emailarray[$i],'company'=>$mediclaimcompany[$i],'policy'=>$policyno[$i]);
                Mail::send([],$email, function ($message) use ($email)  {
                    $message->to($email['email']);
                    $message->subject("Reminder");
                    $message->setBody('Hi, welcome user! naveen g these is a reminder regarding MedicalClaim, Your MedicalClaim policy with policy number: '.$email['policy'].' and Medicalim company : '.$email['company'].'  is get expired please renew it');                 
                 });
            }
            echo "completed";
    }

}
