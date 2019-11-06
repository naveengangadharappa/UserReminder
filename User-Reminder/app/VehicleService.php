<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleService extends Model
{
    //
    protected $fillable = [
        'VehicleType', 'VehicleNumber','DateOfPurchase', 'Servicing1DueDate','Servicing2DueDate','Servicing3DueDate','PUCExpirydate',
    ];
}
