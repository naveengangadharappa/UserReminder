<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Electronics extends Model
{
    //
    protected $fillable = ['ItemName', 'Itemnumber','DateOfPurchase', 'WarrantyPeriod','ReminderFrequency',
        
    ];
}
