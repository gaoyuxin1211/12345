<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
class EcaController extends Controller
{
	//添加
    public function add()
    {
    	// echo "11111";
    
         //查询省份
        $provinceInfo=$this->getAreaInfo(0);
        // print_r($provinceInfo);exit;
        return view('/eca/add',compact('provinceInfo'));
    }
    //添加执行
    public function add_do(Request $request)
    {
    	$data = $request->except(['_token']);
    	// dd($data);
        //验证方法
        $validatedData = $request->validate([
        'eca_name'=>'required',
        'eca_age' => 'required|max:19',

        
        ],[
            'eca_name.required'=>'用户名称不能空',
            'eca_age.required'=>'身份证不能空',
            
            
        ]);
        // dd($data);
        $res=DB::table('eca')->insert($data);
        // dd($res);
        if($res){
            return redirect('/');
        }else{
            return error('添加失败','/eca/add');
        }
    }

    public function getAddressInfo()
    {
        
        $addressInfo=DB::table('eca')->get();
        // dump($addressInfo);exit;
        if(!empty($addressInfo)){
            //处理省市区
            foreach ($addressInfo as $k => $v) {
                $addressInfo[$k]->province=DB::table('Area')->where('id',$v->province)->value('name');
                $addressInfo[$k]->city=DB::table('Area')->where('id',$v->city)->value('name');
                $addressInfo[$k]->area=DB::table('Area')->where('id',$v->area)->value('name');
            }
            return $addressInfo;
        }else{
            return false;
        }
    }

    
     //获取地区
    public function getAreaInfo($pid)
    {
        $where=[
            ['pid','=',$pid]
        ];
        $areaInfo=DB::table('area')->where($where)->get();
        return $areaInfo;
    }
    
    //获取区域
    public function getArea()
    {
        // echo "获取区域";die;
        $id=request()->id;
        $aresInfo=$this->getAreaInfo($id);
        // print_r($aresInfo);die;
        echo json_encode($aresInfo);
    }



    public function list()
    {
    	echo "2222";
    }
}
