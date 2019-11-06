<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildrenVaccin extends Model
{
    //
    protected $fillable = [
        'ChildName', 'DateOfBirth',
    ];
}
