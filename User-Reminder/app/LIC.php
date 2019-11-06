<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LIC extends Model
{
    //
    protected $fillable = [
        'Policynumber', 'PolicyHolder','LicPlanName', 'SumAssuredAmount','PremiumAmount','PremiumPayingTerm','ReminderFrequency',
    ];
}
