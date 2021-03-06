<?php

namespace App\model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Mail;
use Nexmo\Laravel\Facade\Nexmo;

class map extends Model
{
    public function insert($Email,$MediClaimPolicyNumber,$LicPolicyNumber,$VehicleNumber,$ItemNumber,$ChildId)
    {
        DB::connection('mysql')->insert("insert into mapping(Email,MediClaimPolicyNumber,LicPolicyNumber,VehicleNumber,ItemNumber,ChildId) values(?,?,?,?,?,?)",
        [$Email,$MediClaimPolicyNumber,$LicPolicyNumber,$VehicleNumber,$ItemNumber,$ChildId]);
    }


    public function register()
    {
        return redirect("/login");
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
       $map->licReminder();
       $map->vehicleReminder();
       $map->electronicsReminder();
       $map->vaccinReminder();
    }


    public function MediclaimReminder()
    {
        $data=DB::connection('mysql')->select("select users.Mobilenumber,users.Remindertype,DateOfPurchase,ReminderFrequency,PolicyNumber,MediclaimCompany,users.email from mediclaims,users where users.email=mediclaims.email and users.status='active'");
        $policyno=array();
        $cnt=0;
        $emailarray=array();
        $mediclaimcompany=array();
        $remindertype=array();
        $mobno=array();
        $emailsubject='';
        $emailmsg='';
        foreach($data as $values)
            {
                $date1A = date("d-m-Y");
                $date1 = date_create($date1A);
                $date2 = date_create($values->DateOfPurchase);
                $intverl=date_diff($date1,$date2);
                $c=$intverl->format("%a");
                //if(($c+365)-365==$values->ReminderFrequency)
                if((365-$c)==$values->ReminderFrequency)
                {
                     $policyno[$cnt]=$values->PolicyNumber;
                     $emailarray[$cnt]=$values->email;
                     $mediclaimcompany[$cnt]=$values->MediclaimCompany;
                     $remindertype[$cnt]=$values->Remindertype;
                     $mobno[$cnt]=$values->Mobilenumber;
                     $cnt++;
                }
            }
        for($i=0;$i<count($policyno);$i++)
            {
                $email=array('email'=>$emailarray[$i],'company'=>$mediclaimcompany[$i],'policy'=>$policyno[$i]);
                switch($remindertype[$i])
                {
                    case 'sms':
                        Nexmo::message()->send([
                            'to'   => '+91 '.$mobno[$i],
                            'from' => '+91 74833 34815 ',
                            'text' => 'Hi, Goodmorning these is a reminder regarding MedicalClaim, Your MedicalClaim policy with policy number: '.$email['policy'].' and Medicalim company : '.$email['company'].'  is get expired please renew it.'
                        ]);
                    break;
                    case 'email':
                        Mail::send([],$email, function ($message) use ($email)  {
                        $message->to($email['email']);
                        $message->subject("Reminder");
                        $message->setBody('Hi, Goodmorning these is a reminder regarding MedicalClaim, Your MedicalClaim policy with policy number: '.$email['policy'].' and Medicalim company : '.$email['company'].'  is get expired please renew it');                 
                     });
                    break;
                    case 'smsemail':
                        Mail::send([],$email, function ($message) use ($email)  {
                            $message->to($email['email']);
                            $message->subject("Reminder");
                            $message->setBody('Hi, Goodmorning these is a reminder regarding MedicalClaim, Your MedicalClaim policy with policy number: '.$email['policy'].' and Medicalim company : '.$email['company'].'  is get expired please renew it');                 
                         });
                         Nexmo::message()->send([
                            'to'   => '+91 '.$mobno[$i],
                            'from' => '+91 74833 34815 ',
                            'text' => 'Hi, Goodmorning these is a reminder regarding MedicalClaim, Your MedicalClaim policy with policy number: '.$email['policy'].' and Medicalim company : '.$email['company'].'  is get expired please renew it.'
                        ]);
                    break;
                }
            }
            echo "completed";
    }
    public function electronicsReminder()
    {
        $data=DB::connection('mysql')->select("select users.Mobilenumber,users.Remindertype,WarrantyPeriod,DateOfPurchase,ReminderFrequency,ItemNumber,ItemName,electronics.email from electronics,users where users.email=electronics.email and users.status='active'");
        $Itemno=array();
        $cnt=0;
        $emailarray=array();
        $Itemname=array();
        $remindertype=array();
        $mobno=array();
        $emailsubject='';
        $emailmsg='';
        $ReminderFrq='';
        foreach($data as $values)
            {
                $date1A = date("d-m-Y");
                $date1 = date_create($date1A);
                $date2 = date_create($values->DateOfPurchase);
                $intverl=date_diff($date1,$date2);
                $c=$intverl->format("%a");
                $warrentyperiod=$values->WarrantyPeriod;
                switch($warrentyperiod)
                {
                    case '91':if((91-$c)==$values->ReminderFrequency)
                    {
                         $Itemno[$cnt]=$values->ItemNumber;
                         $emailarray[$cnt]=$values->email;
                         $Itemname[$cnt]=$values->ItemName;
                         $remindertype[$cnt]=$values->Remindertype;
                         $mobno[$cnt]=$values->Mobilenumber;
                         $cnt++;
                    }
                    break;
                    case '182':if((182-$c)==$values->ReminderFrequency)
                    {
                         $Itemno[$cnt]=$values->ItemNumber;
                         $emailarray[$cnt]=$values->email;
                         $Itemname[$cnt]=$values->ItemName;
                         $remindertype[$cnt]=$values->Remindertype;
                         $mobno[$cnt]=$values->Mobilenumber;
                         $cnt++;
                    }
                    break;
                    case '1':if((365-$c)==$values->ReminderFrequency)
                    {
                         $Itemno[$cnt]=$values->ItemNumber;
                         $emailarray[$cnt]=$values->email;
                         $Itemname[$cnt]=$values->ItemName;
                         $remindertype[$cnt]=$values->Remindertype;
                         $mobno[$cnt]=$values->Mobilenumber;
                         $cnt++;
                    }
                    break;
                    case '2':if((730-$c)==$values->ReminderFrequency)
                    {
                         $Itemno[$cnt]=$values->ItemNumber;
                         $emailarray[$cnt]=$values->email;
                         $Itemname[$cnt]=$values->ItemName;
                         $remindertype[$cnt]=$values->Remindertype;
                         $mobno[$cnt]=$values->Mobilenumber;
                         $cnt++;
                    }
                    break;
                    case '3':if((1095-$c)==$values->ReminderFrequency)
                    {
                         $Itemno[$cnt]=$values->ItemNumber;
                         $emailarray[$cnt]=$values->email;
                         $Itemname[$cnt]=$values->ItemName;
                         $remindertype[$cnt]=$values->Remindertype;
                         $mobno[$cnt]=$values->Mobilenumber;
                         $cnt++;
                    }
                    break;
                    case '5':if((1825-$c)==$values->ReminderFrequency)
                    {
                         $Itemno[$cnt]=$values->ItemNumber;
                         $emailarray[$cnt]=$values->email;
                         $Itemname[$cnt]=$values->ItemName;
                         $remindertype[$cnt]=$values->Remindertype;
                         $mobno[$cnt]=$values->Mobilenumber;
                         $cnt++;
                    }
                    break;
                    case '6':if((2190-$c)==$values->ReminderFrequency)
                    {
                         $Itemno[$cnt]=$values->ItemNumber;
                         $emailarray[$cnt]=$values->email;
                         $Itemname[$cnt]=$values->ItemName;
                         $remindertype[$cnt]=$values->Remindertype;
                         $mobno[$cnt]=$values->Mobilenumber;
                         $cnt++;
                    }
                    break;
                    case '8':if((2920-$c)==$values->ReminderFrequency)
                    {
                         $Itemno[$cnt]=$values->ItemNumber;
                         $emailarray[$cnt]=$values->email;
                         $Itemname[$cnt]=$values->ItemName;
                         $remindertype[$cnt]=$values->Remindertype;
                         $mobno[$cnt]=$values->Mobilenumber;
                         $cnt++;
                    }
                    break;
                    case '10':if((3650-$c)==$values->ReminderFrequency)
                    {
                         $Itemno[$cnt]=$values->ItemNumber;
                         $emailarray[$cnt]=$values->email;
                         $Itemname[$cnt]=$values->ItemName;
                         $remindertype[$cnt]=$values->Remindertype;
                         $mobno[$cnt]=$values->Mobilenumber;
                         $cnt++;
                    }
                    break;
                }
                //if(($c+365)-365==$values->ReminderFrequency)
            }
        for($i=0;$i<count($Itemno);$i++)
            {
                $email=array('email'=>$emailarray[$i],'ItemName'=>$Itemname[$i],'ItemNumber'=>$Itemno[$i],'RF'=>$ReminderFrq);
                switch($remindertype[$i])
                {
                    case 'sms':
                        Nexmo::message()->send([
                            'to'   => '+91 '.$mobno[$i],
                            'from' => '+91 74833 34815 ',
                            'text' => 'Hi, Goodmorning these is a reminder regarding Electronic Item Warrenty, Your Electronic item with Item number: '.$email['ItemNumber'].' and Item Name : '.$email['ItemName'].'  is getting expired with in '.$email['RF'].' days'
                        ]);
                    break;
                    case 'email':
                        Mail::send([],$email, function ($message) use ($email)  {
                            $message->to($email['email']);
                            $message->subject("Reminder");
                            $message->setBody('Hi, Goodmorning these is a reminder regarding Electronic Item Warrenty, Your Electronic item with Item number: '.$email['ItemNumber'].' and Item Name : '.$email['ItemName'].'  is getting expired with in '.$email['RF'].' days');                 
                         });
                    break;
                    case 'smsemail':
                        Mail::send([],$email, function ($message) use ($email)  {
                            $message->to($email['email']);
                            $message->subject("Reminder");
                            $message->setBody('Hi, Goodmorning these is a reminder regarding Electronic Item Warrenty, Your Electronic item with Item number: '.$email['ItemNumber'].' and Item Name : '.$email['ItemName'].'  is getting expired with in '.$email['RF'].' days');                 
                         });
                         Nexmo::message()->send([
                            'to'   => '+91 '.$mobno[$i],
                            'from' => '+91 74833 34815 ',
                            'text' => 'Hi, Goodmorning these is a reminder regarding Electronic Item Warrenty, Your Electronic item with Item number: '.$email['ItemNumber'].' and Item Name : '.$email['ItemName'].'  is getting expired with in '.$email['RF'].' days'
                        ]);
                    break;
                }
            }
            echo "completed";
    }
    public function vehicleReminder()
    {
        $data=DB::connection('mysql')->select("select users.Mobilenumber,users.Remindertype,Servicing1DueDate,Servicing2DueDate,Servicing3DueDate,vehicle_services.email,VehicleNumber from vehicle_services,users where users.email=vehicle_services.email and users.status='active'");
        $vehicleno=array();
        $cnt=0;
        $emailarray=array();
        $mediclaimcompany=array();
        $remindertype=array();
        $mobno=array();
        $emailsubject='';
        $emailmsg='';
        foreach($data as $values)
            {
                $date1A = date("d-m-Y");
                $date1 = date_create($date1A);
                $date2 = date_create($values->Servicing1DueDate);
                $date3 = date_create($values->Servicing2DueDate);
                $date4 = date_create($values->Servicing3DueDate);
                $intverl=date_diff($date1,$date2);
                $intverl1=date_diff($date1,$date3);
                $intverl2=date_diff($date1,$date4);
                $c1=$intverl->format("%a");
                $c2=$intverl1->format("%a");
                $c3=$intverl2->format("%a");
                // sending a reminder 7 days/1 week before
                if($c1==7||$c2==7||$c3=7)
                {
                    $vehicleno[$cnt]=$values->VehicleNumber;
                     $emailarray[$cnt]=$values->email;
                     $remindertype[$cnt]=$values->Remindertype;
                     $mobno[$cnt]=$values->Mobilenumber;
                     $cnt++;
                }
            }
        for($i=0;$i<count($vehicleno);$i++)
            {
                $email=array('email'=>$emailarray[$i],'vehicle'=>$vehicleno[$i]);
                switch($remindertype[$i])
                {
                    case 'sms':
                        Nexmo::message()->send([
                            'to'   => '+91 '.$mobno[$i],
                            'from' => '+91 74833 34815 ',
                            'text' => 'Hi, Goodmorning these is a reminder regarding vehicle service, Your Vehicle Servicing Data with vehicle number: '.$email['vehicle'].' is get expired in 7 days'
                        ]);
                    break;
                    case 'email':
                        Mail::send([],$email, function ($message) use ($email)  {
                            $message->to($email['email']);
                            $message->subject("Reminder");
                            $message->setBody('Hi, Goodmorning these is a reminder regarding vehicle service, Your Vehicle Servicing Data with vehicle number: '.$email['vehicle'].' is get expired in 7 days');                 
                         });
                    break;
                    case 'smsemail':
                        Mail::send([],$email, function ($message) use ($email)  {
                            $message->to($email['email']);
                            $message->subject("Reminder");
                            $message->setBody('Hi, Goodmorning these is a reminder regarding vehicle service, Your Vehicle Servicing Data with vehicle number: '.$email['vehicle'].' is get expired in 7 days');                 
                         });
                         Nexmo::message()->send([
                            'to'   => '+91 '.$mobno[$i],
                            'from' => '+91 74833 34815 ',
                            'text' => 'Hi, Goodmorning these is a reminder regarding vehicle service, Your Vehicle Servicing Data with vehicle number: '.$email['vehicle'].' is get expired in 7 days'
                        ]);
                    break;
                }
            }
            echo "completed";
    }
    public function licReminder()
    {
        $data=DB::connection('mysql')->select("select users.Mobilenumber,users.Remindertype,DateOfPurchase,ReminderFrequency,Policynumber,PremiumPayingTerm,l_i_c_s.email from l_i_c_s,users where users.email=l_i_c_s.email and users.status='active'");
        $policyno=array();
        $pptarr=array();
        $cnt=0;
        $emailarray=array();
        $remindertype=array();
        $mobno=array();
        $emailsubject='';
        $emailmsg='';
        foreach($data as $values)
            {
                $date1A = date("d-m-Y");
                $date1 = date_create($date1A);
                $date2 = date_create($values->DateOfPurchase);
                $intverl=date_diff($date1,$date2);
                $c=$intverl->format("%a");
                $ppt=$values->PremiumPayingTerm;

                switch($ppt)
                {
                    case 'Monthly':if((31-$c)==$values->ReminderFrequency||(59-$c)==($values->ReminderFrequency)||(90-$c)==($values->ReminderFrequency)||(120-$c)==($values->ReminderFrequency)||(151-$c)==($values->ReminderFrequency)||(181-$c)==($values->ReminderFrequency)||(212-$c)==$values->ReminderFrequency||(243-$c)==($values->ReminderFrequency)||(273-$c)==($values->ReminderFrequency)||(304-$c)==($values->ReminderFrequency)||(334-$c)==($values->ReminderFrequency)||(365-$c)==($values->ReminderFrequency))
                    {
                        echo "Monthly entered";
                         $policyno[$cnt]=$values->Policynumber;
                         $emailarray[$cnt]=$values->email;
                         $pptarr[$cnt]='Monthly';
                         $remindertype[$cnt]=$values->Remindertype;
                         $mobno[$cnt]=$values->Mobilenumber;
                         $cnt++;
                    }
                    break;
                    case 'Quarterly':if((90-$c)==$values->ReminderFrequency||(181-$c)==($values->ReminderFrequency)||(273-$c)==($values->ReminderFrequency)||(365-$c)==($values->ReminderFrequency))
                    {
                        echo "Quarterly entered";
                        $policyno[$cnt]=$values->Policynumber;
                        $emailarray[$cnt]=$values->email;
                        $pptarr[$cnt]='Quarterly';
                        $remindertype[$cnt]=$values->Remindertype;
                        $mobno[$cnt]=$values->Mobilenumber;
                        $cnt++;
                    }
                    break;
                    case 'HalfYear':if((182-$c)==$values->ReminderFrequency||(365-$c)==$values->ReminderFrequency)
                    {
                        echo "Halfyear entered";
                        $policyno[$cnt]=$values->Policynumber;
                        $emailarray[$cnt]=$values->email;
                        $pptarr[$cnt]='HalfYear';
                        $remindertype[$cnt]=$values->Remindertype;
                        $mobno[$cnt]=$values->Mobilenumber;
                        $cnt++;
                    }
                    break;
                    case 'Yearly':if((365-$c)==$values->ReminderFrequency)
                    {
                        $policyno[$cnt]=$values->Policynumber;
                        $emailarray[$cnt]=$values->email;
                        $pptarr[$cnt]='Yearly';
                        $remindertype[$cnt]=$values->Remindertype;
                        $mobno[$cnt]=$values->Mobilenumber;
                        $cnt++;
                    }
                    break;
                }
                //if(($c+365)-365==$values->ReminderFrequency)
            }
        for($i=0;$i<count($policyno);$i++)
            {
                $email=array('email'=>$emailarray[$i],'ppt'=>$pptarr[$i],'policy'=>$policyno[$i]);
                switch($remindertype[$i])
                {
                    case 'sms':
                        Nexmo::message()->send([
                            'to'   => '+91 '.$mobno[$i],
                            'from' => '+91 74833 34815 ',
                            'text' => 'Hi, Good Morning these is a reminder regarding LIC Policy, Your LIC policy with policy number: '.$email['policy'].' with Premium Paying Term :'.$email['ppt'].' is near please pay'
                        ]);
                    break;
                    case 'email':
                        Mail::send([],$email, function ($message) use ($email)  {
                            $message->to($email['email']);
                            $message->subject("Reminder");
                            $message->setBody('Hi, Good Morning these is a reminder regarding LIC Policy, Your LIC policy with policy number: '.$email['policy'].' with Premium Paying Term :'.$email['ppt'].' is near please pay');                 
                         });
                    break;
                    case 'smsemail':
                        Mail::send([],$email, function ($message) use ($email)  {
                            $message->to($email['email']);
                            $message->subject("Reminder");
                            $message->setBody('Hi, Good Morning these is a reminder regarding LIC Policy, Your LIC policy with policy number: '.$email['policy'].' with Premium Paying Term :'.$email['ppt'].' is near please pay');                 
                         });
                         Nexmo::message()->send([
                            'to'   => '+91 '.$mobno[$i],
                            'from' => '+91 74833 34815 ',
                            'text' => 'Hi, Good Morning these is a reminder regarding LIC Policy, Your LIC policy with policy number: '.$email['policy'].' with Premium Paying Term :'.$email['ppt'].' is near please pay'
                        ]);
                    break;
                }
            }
            echo "completed";
    }
    public function vaccinReminder()
    {
        $data=DB::connection('mysql')->select("select u.Mobilenumber,u.Remindertype,v.VaccinationName,v.VaccinationDuedate,c.ChildName,c.email from children_vaccins c,add_vaccinations v,users u where c.ChildId=v.ChildId and u.status='active'");
        $vaccinname=array();
        $cnt=0;
        $emailarray=array();
        $childname=array();
        $remindertype=array();
        $mobno=array();
        $emailsubject='';
        $emailmsg='';
        foreach($data as $values)
            {
                $date1A = date("d-m-Y");
                $date1 = date_create($date1A);
                $date2 = date_create($values->VaccinationDuedate);
                $intverl=date_diff($date1,$date2);
                $c=$intverl->format("%a");
                //if(($c+365)-365==$values->ReminderFrequency)
                
                //Sending reminder 7 days/1 week before
                if($c==7)
                {
                    echo "entered";
                     $vaccinname[$cnt]=$values->VaccinationName;
                     $emailarray[$cnt]=$values->email;
                     $childname[$cnt]=$values->ChildName;
                     $remindertype[$cnt]=$values->Remindertype;
                     $mobno[$cnt]=$values->Mobilenumber;
                     $cnt++;
                }
            }
        for($i=0;$i<count($vaccinname);$i++)
            {
                $email=array('email'=>$emailarray[$i],'vaccin'=>$vaccinname[$i],'child'=>$childname[$i]);
                switch($remindertype[$i])
                {
                    case 'sms':
                        Nexmo::message()->send([
                            'to'   => '+91 '.$mobno[$i],
                            'from' => '+91 74833 34815 ',
                            'text' => 'Hi, Good Morning these is a reminder regarding Children Vaccination, Your Child vaccination with Child name : '.$email['child'].' and Vaccination Name : '.$email['vaccin'].'  will be expired in 7 days please Vaccinate your child.'
                        ]);
                    break;
                    case 'email':
                        Mail::send([],$email, function ($message) use ($email)  {
                            $message->to($email['email']);
                            $message->subject("Reminder");
                            $message->setBody('Hi, Good Morning these is a reminder regarding Children Vaccination, Your Child vaccination with Child name : '.$email['child'].' and Vaccination Name : '.$email['vaccin'].'  will be expired in 7 days please Vaccinate your child.');                 
                         });
                    break;
                    case 'smsemail':
                        Mail::send([],$email, function ($message) use ($email)  {
                            $message->to($email['email']);
                            $message->subject("Reminder");
                            $message->setBody('Hi, Good Morning these is a reminder regarding Children Vaccination, Your Child vaccination with Child name : '.$email['child'].' and Vaccination Name : '.$email['vaccin'].'  will be expired in 7 days please Vaccinate your child.');                 
                         });
                         Nexmo::message()->send([
                            'to'   => '+91 '.$mobno[$i],
                            'from' => '+91 74833 34815 ',
                            'text' => 'Hi, Good Morning these is a reminder regarding Children Vaccination, Your Child vaccination with Child name : '.$email['child'].' and Vaccination Name : '.$email['vaccin'].'  will be expired in 7 days please Vaccinate your child.'
                        ]);
                    break;
                }
            }
            echo "completed";
    }

}
