<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mediclaim extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','PolicyNumber', 'MediclaimCompany','DateOfPurchase', 'PremiumAmount','ReminderFrequency',
    ];

}
