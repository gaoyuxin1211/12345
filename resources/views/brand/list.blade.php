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
		<input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入关键字">
		<input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="网址"><button>搜索</button>
	</form>
	<table border=1>
		<tr>
			<td>品牌Id</td>
			<td>品牌名称</td>
			<td>品牌描述</td>

			<td>品牌Logo</td>
			<td>品牌网址</td>
			<td>操作</td>
		</tr>
		@if($data)
		@foreach($data as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_desc}}</td>
			<td><img src="{{config('app.img_url')}}{{$v->brand_logo}}" width="30"></td>
			<td>{{$v->brand_url}}</td>
			<td>
				<a href="{{url('/brand/edit',['brand_id'=>$v->brand_id])}}">编辑</a>
				<a href="{{url('/brand/del',['brand_id'=>$v->brand_id])}}">删除</a>
			</td>
		</tr>
		@endforeach
		@endif
	</table>
	{{$data->appends($query)->links()}}
</body>
</html>