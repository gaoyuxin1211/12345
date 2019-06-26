<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    public function proinfo($id){
    	$data=DB::table('goods')->where('goods_id',$id)->get();
    	// dd($data);
    	return view('index/goods/proinfo',['data'=>$data]);
    }

}
