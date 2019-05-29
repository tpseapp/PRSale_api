<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'event_id';

    //public $incrementing = true; //หากไม่ได้รัน primaryKey เป็น AI ให้เป็น false

    protected $hidden = [

    ];

    //protected $keyType = 'int';
    //public $timestamps = true;


}
