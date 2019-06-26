<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table='user';
    protected $primarykey='user_id';
    protected $guarded = [];
}
