<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table='cart';
    protected $primarykey='cate_id';
     // public $timestamps = false;
     const CREATED_AT = 'addtime';
}
