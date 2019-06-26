<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AdminController extends Controller
{
	//添加
    public function add()
    {
    	// echo '1111';
    	return view('admin/add');
    }
    //执行添加的
    public function add_do(Request $request)
    {
    	$data = $request->except(['_token']);
    	$data['admin_time']=time();
        //验证方法1
        $validatedData = $request->validate([
        'admin_name' => 'required',
        'admin_pwd' => 'required',
        'admin_repwd' => 'required',
        'admin_email' => 'required|email',
        

        ],[
            'admin_name.required'=>'用户名称不能空',
            'admin_pwd.required'=>'密码不能空',
            'admin_repwd.required'=>'确认密码不能空',

            'admin_email.required'=>'邮箱不能空',
            'admin_email.email'=>'邮箱格式不对',

        ]);
        //dd($data);
        $res=DB::table('admin')->insert($data);
        // dd($res);
        if($res){
            return redirect('/admin/list');
        }else{
            return error('添加失败','/admin/add');
        }
    }
    //展示
    public function list()
    {
    	 $keywords=request()->keywords;
       $where=[];
       if($keywords){
        $where[]=['admin_name','like',"%$keywords%"];
       }


       $pageSize=config('app.pageSize');
       // dd($pageSize);
       $data=DB::table('admin')->where($where)->paginate($pageSize);
        return view('/admin/list',['data'=>$data,'keywords'=>$keywords]);
    }
}
