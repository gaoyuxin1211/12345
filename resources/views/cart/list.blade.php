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
		<input type="text" name="cart_name" value="{{$query['cart_name']??''}}" placeholder="请输入关键字">
		<input type="text" name="cart_pate" value="{{$query['cart_pate']??''}}" placeholder="描述"><button>搜索</button>
	</form>
	<table border=1>
		<tr>
			<td>分类Id</td>
			<td>分类名称</td>
			<td>是否显示</td>

			<td>父级分类</td>
			<td>描述</td>
			<td>操作</td>
		</tr>
		@if($data)
		@foreach($data as $v)
		<tr>
			<td>{{$v->cate_id}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->is_show}}</td>
			<td>{{$v->parent_id}}</td>
			<td>{{$v->cate_desc}}</td>
			<td>
				<a href="{{url('/cart/edit',['brand_id'=>$v->brand_id])}}">编辑</a>
				<a href="{{url('/cart/del',['brand_id'=>$v->brand_id])}}">删除</a>
			</td>
		</tr>
		@endforeach
		@endif
	</table>
	{{$data->appends($query)->links()}}
</body>
</html>