<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeRecord extends Model
{
    protected $table = 'time_record';
    //protected $primaryKey = 'id';

    //public $incrementing = true; //หากไม่ได้รัน primaryKey เป็น AI ให้เป็น false

    protected $hidden = [

    ];

    //protected $keyType = 'int';
    //public $timestamps = false;

    public function time_coordinates()
    {
        return $this->belongsTo(TimeCoordinates::class, 'employee_id' , 'employee_id' , 'date' , 'date');
    }

}
