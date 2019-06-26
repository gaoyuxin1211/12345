<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     protected $table='article';
    protected $primarykey='article_id';
     // public $timestamps = false;
     const CREATED_AT = 'addtime';
}
