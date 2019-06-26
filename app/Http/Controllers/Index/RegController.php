<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Login;

use DB;
class RegController extends Controller
{
    /**
     * Display a listing of the resource.
     * 注册的
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo "111";
        return view('index/reg'); 
    }
 /**
     * Display a listing of the resource.
     * 登录
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        // echo "111";
        return view('index/login'); 
    }

    /**
     * Show the form for creating a new resource.
     * 注册的
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('index/add');
    }

    /**
     * Store a newly created resource in storage.
     *注册执行
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_do()
    {
        // echo 1111;
       // $user_code=session('user_code');
       // dd($user_code);
       $user_email=request()->user_email;
       // dd($user_email);
       $user_code=request()->user_code;
       $user_pwd=request()->user_pwd;
       $post['user_email']=$user_email;
       $post['user_code']=$user_code;
       $post['user_pwd']=md5($user_pwd);
       $res=Login::create($post);
       if($res){
        return redirect('index/login');
       }
    }

     /**
     * Show the form for creating a new resource.
     * 登录的
     * @return \Illuminate\Http\Response
     */
    public function aaaa()
    {
        return view('index/aaaa');
    }

    /**
     * Store a newly created resource in storage.
     *登录执行
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function aaa_do()
    {
        // echo 1111;
        $user_email = request()->user_email;
        $user_pwd = request()->user_pwd;
        $user_pwd=md5($user_pwd);
        // dump($user_email);
        // dd($user_pwd);
        $res=Login::where('user_email',$user_email)->where('user_pwd',$user_pwd)->first();
        // dd($res);
        if($res){
            session(['user_email'=>$user_email]);
            echo json_encode(['code'=>1,'font'=>'登录成功']);
        }else{
            echo json_encode(['code'=>2,'font'=>'登录失败']);
        } 
    }
    //退出登录
    public function logout()
    {
        request()->session()->forget('user_email');
        return redirect('/');
    }



    
     //检查唯一性
    public function checkName(){
        $user_email=request()->user_email;
        if($user_email){
            $where['user_email']=$user_email;
            $count=DB::table('user')->where($where)->count();
            return ['code'=>1,'count'=>$count];
        }
    }



    //发送邮件
    public function sendemail()
    {
        $user_email=request()->user_email;
        $rand=rand(1000,9999);
        session(['user_email'=>$user_email]);
        session(['rand'=>$rand]);
        // dd($user_email);
        $res=$this->send($user_email,$rand);
        if(!$res){
            return ['code'=>1,'count'=>'发送成功'];
        }else{
            return ['code'=>0,'count'=>'发送失败'];
        }
    }
    public function send($user_email,$rand){
        \Mail::raw('验证码：'.$rand ,function($message)use($user_email){
            
            //设置主题
            $message->subject("欢迎注册李翔有限公司");
            //设置接收方
            $message->to($user_email);
        });
    }
}
