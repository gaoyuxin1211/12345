<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\model\Article;
use DB;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo 'ddddd';
         $query=request()->all();
       $where=[];
       if($query['article_name']??''){
        $where[]=['article_name','like',"%$query[article_name]%"];
       }
        if($query['article_parent']??''){
        $where['article_parent']=$query['article_parent'];
       }

       $pageSize=config('app.pageSize');
         $data=Article::where($where)->paginate($pageSize);
        return view('/article/list',['data'=>$data,'query'=>$query]);
        
        // return view('article/list');
    }

    /**
     * 
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        // echo '5222';
        // $res = Article::get();
        // $res = $this -> createTree($res);
        return view('article/add');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_do(Request $request)
    {
         $data = $request->except(['_token']);
         // $data = $request->input();
        // dd($data);
        $data['addtime']=time();
         $validatedData = $request->validate([
        'article_name' => 'required|unique:article',
        'article_desc' => 'required',
        'article_email' => 'required|email',
        

        ],[
            'article_name.required'=>'分类名称不能空',
            'article_name.unique'=>'不能重复',
            'article_desc.required'=>'描述不能空',
            'article_email.required'=>'邮箱不能空',
            'article_email.email'=>'邮箱格式不对',
            

        ]);
         //上传图片
          if($request->hasFile('article_logo')){
            $res = $this->upload($request,'article_logo');
            // dd($res);
            if($res['code']){
                $data['article_logo']=$res['imgurl']; 
            }
        }
        //exit;
    
        
    

         // echo 1111;exit;
         // dd($data);
         $res=Article::insert($data);
          if($res){
            return redirect('/article/list');
        }else{
            return error('添加失败','/article/add');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo '23456';
        $data=DB::table('article')->where('article_id','=',$id)->first();
        // $res=::table('')->get();
        // dd($data);
        return view('Article/edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
         $data = request()->except('_token');
         // dd($data);
         




        //上传图片
          if(request()->hasFile('article_logo')){
            $res = $this->upload($request,'article_logo');
            // dd($res);
            if($res['code']){
                $data['article_logo']=$res['imgurl']; 
            }
        }

        // $res=Article::where(['article_id'=>$id])->update($data);
         $res=DB::table('article')->where(['article_id'=>$id])->update($data);
          if($res){
            return redirect('/article/list');
        }else{
            return ('修改失败');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // $res=DB::table('article')->where('article_id','=',$id)->delete();
    //     // dd($res);
    //     if($res){
    //         return redirect('/article/list');
    //     }else{
    //         return error('删除失败','/article/list');
    //     }
    // 
        $res = Article::where('article_id','=',$id)->delete();
        if($res){
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
             return ['code'=>0,'msg'=>'删除失败'];
        }
    }

    //检查唯一性
    public function checkName(){
        $article_name=request()->article_name;
        if($article_name){
            $where['article_name']=$article_name;
            $count=Article::where($where)->count();
            return ['code'=>1,'count'=>$count];
        }
    }
}
