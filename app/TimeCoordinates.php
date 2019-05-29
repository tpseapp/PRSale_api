<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeCoordinates extends Model
{
    protected $table = 'time_coordinates';
    //protected $primaryKey = 'id';

    //public $incrementing = true; //หากไม่ได้รัน primaryKey เป็น AI ให้เป็น false

    protected $hidden = [

    ];

    //protected $keyType = 'int';
    //public $timestamps = true;


}
