<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModEmployee extends Model
{
    protected $table = 'mod_employee';
    protected $primaryKey = 'id_employee';

    public $incrementing = false;

    protected $hidden = [
        'username',
        'surname',
        "username_en",
        "surname_en",
        "department",
        "birthday",
        "position",
        "position_en",
        "code_id",
        "detail_employee",
        "detail_employee_en",
        "email",
        "user_city",
        "user_state",
        "user_district",
        "detail_city",
        "tel",
    ];

    protected $keyType = 'string';
    public $timestamps = false;
}
