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
    public function updatemap($Email,$choice,$mapdata)
    {
        $MediClaimPolicyNumber='';
        $LicPolicyNumber='';
        $VehicleNumber='';
        $ItemNumber='';
        $ChildId='';
        switch($choice)
        {
            case 'item':$mappingdata=DB::connection('mysql')->select("select * from mapping where Email=?",[$Email]);
            foreach($mappingdata as $values)
            {
                $ItemNumber=$values->ItemNumber.$mapdata.","; 
            }
            DB::connection('mysql')->update("update mapping set ItemNumber=? where Email=?",[$ItemNumber,$Email]);
            break;
            case 'Lic':$mappingdata=DB::connection('mysql')->select("select LicPolicyNumber from mapping where Email=?",[$Email]);
            foreach($mappingdata as $value)
            {
                $LicPolicyNumber=$value->LicPolicyNumber.$mapdata.",";
            }
            DB::connection('mysql')->update("update mapping set LicPolicyNumber=? where Email=?",[$LicPolicyNumber,$Email]);
            break;
            case 'medical':$mappingdata=DB::connection('mysql')->select("select MediClaimPolicyNumber from mapping where Email=?",[$Email]);
            foreach($mappingdata as $values)
            {
                $MediClaimPolicyNumber=$values->MediClaimPolicyNumber.$mapdata.",";
            }
            DB::connection('mysql')->update("update mapping set MediClaimPolicyNumber=? where Email=?",[$MediClaimPolicyNumber,$Email]);
            break;
            case 'vehicle':$mappingdata=DB::connection('mysql')->select("select VehicleNumber from mapping where Email=?",[$Email]);
            foreach($mappingdata as $values)
            {
                $VehicleNumber=$values->VehicleNumber.$mapdata.",";
            }
            DB::connection('mysql')->update("update mapping set VehicleNumber=? where Email=?",[$VehicleNumber,$Email]);
            break;
            case 'child':$mappingdata=DB::connection('mysql')->select("select ChildId from mapping where Email=?",[$Email]);
            foreach($mappingdata as $values)
            {
                $ChildId=$values->ChildId.$mapdata.",";
            }
            DB::connection('mysql')->update("update mapping set ChildId=? where Email=?",[$ChildId,$Email]);
            DB::connection('mysql')->insert("insert into vaccinmap(ChildId,VaccinationId) values(?,?)",
            [$mapdata,'']);
            break;
        }
        
    }
    public function getChildNames($Email)
    {
        $childdetails=array();
        $mappingdata=DB::connection('mysql')->select("select ChildId from mapping where Email=?",[$Email]);
        foreach($mappingdata as $values)
            {
                $ChildIds=explode(',',$values->ChildId);
                for($i=0;$i<count($ChildIds);$i++)
                {
                    $childdetail=DB::connection('mysql')->select("select ChildId,ChildName from children_vaccins where ChildId=?",[$ChildIds[$i]]);
                    foreach($childdetail as $val)
                    {
                        $childdetails[$i]= $val->ChildName.','.$val->ChildId;
                    }
                }
            }

            return $childdetails;
    }

    public function insertvaccinmap($Email,$childId,$vaccinId)
    {
        $vaccinnumber='';
        $mappingdata=DB::connection('mysql')->select("select VaccinationId from vaccinmap where ChildId=?",[$childId]);
            foreach($mappingdata as $values)
            {
                $vaccinnumber=$values->VaccinationId.$vaccinId.",";
            }
            DB::connection('mysql')->update("update vaccinmap set VaccinationId=? where ChildId=?",[$vaccinnumber,$childId]);   
    }
}
