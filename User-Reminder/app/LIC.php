<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LIC extends Model
{
    //
    protected $fillable = [
        'email','Policynumber', 'PolicyHolder','LicPlanName', 'DateOfPurchase','SumAssuredAmount','PremiumAmount','PremiumPayingTerm','ReminderFrequency',
    ];
}
