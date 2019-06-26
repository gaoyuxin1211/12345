<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class HuoController extends Controller
{
    public function add()
    {
    	// echo "11111";
    	// 
    	$redis = new \Redis();
        $redis -> connect('127.0.0.1','6379');
        $num = $redis -> get('num');
        echo $num."<br/>";
    	return view('huo/add');
    }

    public function add_do(Request $request)
    {
    	$data = $request->except(['_token']);
    	// dd($data);
    	$data['huo_time']=time();
    	// dd($data);
    	

    	//上传图片
          if($request->hasFile('huo_logo')){
            $res = $this->upload($request,'huo_logo');
            // dd($res);
            if($res['code']){
                $data['huo_logo']=$res['imgurl']; 
            }
        }

    	 $res=DB::table('huo')->insert($data);
        // dd($res);
        if($res){
            return redirect('/huo/list');
        }else{
            return error('添加失败','/huo/add');
        }
    }


     public function upload(Request $request,$file){
        // dd($file);
        if($request->file($file)->isValid()){
            $photo = $request->file($file);
            // dd($photo);
            // //$extension = $photo->extension();
            $store_result = $photo->store(date('Ymd'));
            // dd($store_result);
            // //$store_result = $photo->storeAs('photo', 'test.jpg');
            // $output = [
            // 'extension' => $extension,
            // 'store_result' => $store_result
            // ];
             return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'message'=>'上传过程出错'];
        }
    }

    public function index(Request $request)
    {
    	// echo "12345";
    	 $redis = new \Redis();
        $redis -> connect('127.0.0.1','6379');
        $redis -> incr('num');
        $query = \request()->all();

    	 $query=request()->all();
    	 // dd($query);
    	 


    	 $where=[];
       if($query['huo_name']??''){
        $where[]=['huo_name','like',"%$query[huo_name]%"];
       }

    	 $pageSize=config('app.pageSize');
       // dd($pageSize);
       $data=DB::table('huo')->where($where)->paginate($pageSize);
       // dd($data);
        return view('/huo/list',['data'=>$data,'query'=>$query]);
    }

    public function del($id)
    {
    	  $res=DB::table('huo')->where('huo_id','=',$id)->delete();
        // dd($res);
        if($res){
            return redirect('/huo/list');
        }else{
            return error('删除失败','/huo/list');
        }
    }

     public function edit($id)
    {
        // echo '23456';
        $data=DB::table('huo')->where('huo_id','=',$id)->first();
        
        // dd($data);
        return view('huo/edit',['data'=>$data]);
    }

    public function update($id)
    {
    	// dd($id);
    	 $data = request()->except('_token');
         // dd($data);
         

        // //上传图片
        //   if($request->hasFile('huo_logo')){
        //     $res=$this->upload($request,'huo_logo');

        //     // dd($res);
        //     if($res['code']){
        //         $data['huo_logo']=$res['imgurl']; 
        //     }
        // }


         $res=DB::table('huo')->where(['huo_id'=>$id])->update($data);
         // dd($res);
          if($res){
            return redirect('/huo/list');
        }else{
            return ('修改失败');
        }

    } 
}
