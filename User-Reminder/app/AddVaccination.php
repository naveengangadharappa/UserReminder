<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddVaccination extends Model
{
    //
    protected $fillable = [
        'VaccinationId', 'VaccinationName','VaccinationDuedate',
    ];
}
