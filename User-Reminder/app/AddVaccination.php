<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddVaccination extends Model
{
    //
    protected $fillable = [
        'PolicyNumber', 'MediclaimCompany','DateOfPurchase', 'PremiumAmount','ReminderFrequency','PolicyDocument',
    ];
}
