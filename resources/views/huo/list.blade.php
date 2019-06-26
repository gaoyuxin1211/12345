<!DOCTYPE html>
<html>
<head>
	<title>展示</title>
<!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('css/page.css')}}" rel="stylesheet">
 -->

	<link rel="stylesheet" href="{{asset('css/page.css')}}">
</head>
<body>
	<form>
		<input type="text" name="huo_name" value="{{$query['cart_name']??''}}" placeholder="请输入关键字">
		<button>搜索</button>
	</form>
	<table border=1>
		<tr>
			<td>货物Id</td>
			<td>货物名称</td>
			<td>图片</td>
			<td>库存</td>
			<td>时间</td>
			<td>操作</td>
		</tr>
		@if($data)
		@foreach($data as $v)
		<tr>
			<td>{{$v->huo_id}}</td>
			<td>{{$v->huo_name}}</td>
			<td><img src="{{config('app.img_url')}}{{$v->huo_logo}}" width="60"></td>
			<td>{{$v->huo_author}}</td>
			<td>{{date('Y-m-d H:i:s',$v->huo_time)}}</td>
			<td>
				<a href="{{url('/huo/edit',['huo_id'=>$v->huo_id])}}">编辑</a>
				<a href="{{url('/huo/del',['huo_id'=>$v->huo_id])}}">删除</a>
			</td>
		</tr>
		@endforeach
		@endif
	</table>
	{{$data->appends($query)->links()}}
</body>




