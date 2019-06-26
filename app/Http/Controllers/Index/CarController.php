<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CarController extends Controller
{
    public function list()
    {
    	$data=DB::table('cart')->join('goods','cart.goods_id','=','goods.goods_id')->where('cart.is_del','=',1)->get();
    	return view('index/goods/car',['data'=>$data]);
    }
}
