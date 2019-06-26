<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
	protected $table='brand';
    protected $primarykey='brand_id';
    public $timestamps = false;
    protected $fillable = [
    	'brand_name',
    	'brand_desc',
    	'brand_logo',
    	'brand_url',
    ];
}
