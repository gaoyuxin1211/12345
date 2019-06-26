<head>
	<title>展示</title>
<!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{asset('css/page.css')}}" rel="stylesheet">
 -->

	<link rel="stylesheet" href="{{asset('css/page.css')}}">
</head>
<body>
	<form>
		<input type="text" name="keywords" placeholder="请输入关键字"><button>搜索</button>
	</form>
	<table border=1>
		<tr>
			<td>用户Id</td>
			<td>用户名称</td>
			<td>邮箱</td>

			<td>时间</td>
			<td>操作</td>
		</tr>
		@if($data)
		@foreach($data as $v)
		<tr>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
			<td>{{$v->admin_email}}</td>
			<td>{{date('Y-m-d H:i:s',$v->admin_time)}}</td>
			
			<td>
				<a href="{{url('/admin/edit',['admin_id'=>$v->admin_id])}}">编辑</a>
				<a href="{{url('/admin/del',['admin_id'=>$v->admin_id])}}">删除</a>
			</td>
		</tr>
		@endforeach
		@endif
	</table>
	{{$data->appends(['keywords'=>$keywords])->links()}}
</body>
</html>