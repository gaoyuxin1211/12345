<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Cart;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo '让人';
       $query=request()->all();
       $where=[];
       if($query['cate_name']??''){
        $where[]=['cate_name','like',"%$query[cate_name]%"];
       }
        if($query['cate_pate']??''){
        $where['cate_pate']=$query['cate_pate'];
       }

       $pageSize=config('app.pageSize');
         $data=Cart::where($where)->orderBy('cate_id','desc')->paginate($pageSize);
        return view('/cart/list',['data'=>$data,'query'=>$query]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        // echo '比较好';
        $res = Cart::get();
        $res = $this -> createTree($res);
        return view('cart/add',['data'=>$res]);
    }
    // 无限极分类
    function createTree($data,$field='cate_id',$parent_id = 0,$level = 1)
    {
        static $result = [];
        if ($data) {
            foreach ($data as $key => $val) {
                if ($val['parent_id'] == $parent_id) {
                    $val['level'] = $level;
                    $result[] = $val;
                    $this -> createTree($data,$field='cate_id',$val[$field],$level+1);
                }
            }
            return $result;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_do(Request $request)
    {
        // echo '';
        // return view();
        $data = $request->input();
        // dd($data);
        $data['addtime']=time();
         $validatedData = $request->validate([
        'cate_name' => 'required',
        'cate_desc' => 'required',
        
        

        ],[
            'cate_name.required'=>'分类名称不能空',
            'cate_desc.required'=>'描述不能空',
            

        ]);
         // echo 1111;exit;
         // dd($data);
         $res=Cart::insert($data);
         if($res){
            // return \redirect('/cart/list');
            echo 1;
         }else{
            echo 2;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
