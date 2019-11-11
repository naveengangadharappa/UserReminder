<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddVaccination extends Model
{
    //
    protected $fillable = [
        'ChildId','VaccinationId', 'VaccinationName','VaccinationDuedate',
    ];
}
