<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

use App\model\Brand;
class BrandController extends Controller
{
    public function logindo(){
        $email = request()->email;
        $password = request()->password;
        // dump($email);
        // dd($password);

        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            dump(Auth::user());
            dd(Auth::id());
        }else{
            return '登录失败';
        }
    }




    public function sendemail(){
        $email = request()->email;
        // dd($email);
        $this->send($email);
    }
    public function send($email)
    {
          // \Mail::raw('hello' ,function($message)use($email){
        \Mail::send('email',['name'=>$email] ,function($message)use($email){
        //设置主题
            $message->subject("欢迎注册狗龙公司");
        //设置接收方
            $message->to($email);
        });
    }

    /**
     * Display a listing of the resource.
     *展示
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //设置
        // session(['name' => '狗卦']);
        // 取出session的值
        // $name = request()->session()->get('name');
        // // dd($name);
        // 删除session的值
        // $res=request()->session()->forget('name');
        

        // // 存储：
        // Cookie::queue('author', '狗龙', 12);
        // // 获取：
        // $res=Cookie::get('author');
        // // dd($res);
        // // 删除：
        // Cookie::queue(Cookie::forget('author'));







       // echo '姐姐';
       $query=request()->all();
       $where=[];
       if($query['brand_name']??''){
        $where[]=['brand_name','like',"%$query[brand_name]%"];
       }
        if($query['brand_url']??''){
        $where['brand_url']=$query['brand_url'];
       }

       $pageSize=config('app.pageSize');
       // dd($pageSize);
       // DB::connection()->enableQueryLog();//连接
       
       // $data=DB::table('brand')->where($where)->paginate($pageSize);//获取的
        $data=Brand::where($where)->orderBy('brand_id','desc')->paginate($pageSize);
        // $logs = DB::getQueryLog();//执行
        // dd($data);
        return view('/Brand/list',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo '呼呼';
        return view('/Brand/add');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // 第二种验证
    // public function store(StoreBrandPost $request)
    {
        // echo 11;exit;
        // $data=$request->all();
        // dd($data);
        $data = $request->except(['_token']);

        //验证方法1
        // $validatedData = $request->validate([
        // 'brand_name' => 'required|unique:brand|max:255',
        // 'brand_desc' => 'required',
        // ],[
        //     'brand_name.required'=>'不能空',
        // ]);
        // //dd($data);
        
        //第三中验证
        $validator = \Validator::make($request->all(), [
            'brand_name' => 'required|unique:brand|max:10',
            'brand_desc' => 'required',
            ],[

                'brand_name.required'=>'不能空',
                'brand_name.unique'=>'不能重复',
                'brand_name.max'=>'不能超过10',
            ]);
            if ($validator->fails()) {
            return redirect('brand/add')
             ->withErrors($validator)
            ->withInput();
             }
        // echo 123;exit;
        //文件上传
        if($request->hasFile('brand_logo')){
            $res = $this->upload($request,'brand_logo');
            // dd($res);
            if($res['code']){
                $data['brand_logo']=$res['imgurl']; 
            }
        }
        //exit;
    
        // $res=DB::table('brand')->insert($data);
        $res=Brand::insert($data);

         // $res=Brand::create($data);
        // dd($res);
        if($res){
            return redirect('/brand/list');
        }else{
            return error('添加失败','/brand/add');
        }

    }

    public function upload(Request $request,$file){
        // dd($file);
        if($request->file($file)->isValid()){
            $photo = $request->file($file);
            //dd($photo);
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
  

    /**
     * Display the specified resource.
     *展示详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo show;
    }

    /**
     * Show the form for editing the specified resource.
     *修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo '姐姐';
        return view('/Brand/edit');
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo undate;
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($brand_id)
    {
        $res=DB::table('brand')->where('brand_id','=',$brand_id)->delete();
        // dd($res);
        if($res){
            return redirect('/brand/list');
        }else{
            return error('删除失败','/brand/list');
        }
       // echo destroy;
    }
}
