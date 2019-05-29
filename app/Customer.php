<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'cust_id';

    //public $incrementing = true; //หากไม่ได้รัน primaryKey เป็น AI ให้เป็น false

    protected $hidden = [

    ];

    protected $keyType = 'smallint';
    //public $timestamps = true;


}
