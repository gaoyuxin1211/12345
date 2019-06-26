<!DOCTYPE html>
<html>
<head>
	<title>展示</title>

 	<script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
	<link rel="stylesheet" href="{{asset('css/page.css')}}">
</head>
<body>
	<form>
		 <meta name="csrf-token" content="{{ csrf_token() }}">
		<input type="text" name="article_name" value="{{$query['article_name']??''}}" placeholder="请输入关键字">
		<input type="text" name="article_parent" value="{{$query['article_parent']??''}}" placeholder="分类"><button>搜索</button>
	</form>
	<table border=1>
		<tr>
			<td>文章Id</td>
			<td>文章标题</td>
			<td>文章分类</td>
			<td>文章重要性</td>
			<td>是否显示</td>
			<td>时间</td>
			<td>操作</td>
		</tr>
		@if($data)
		@foreach($data as $v)
		<tr>
			<td>{{$v->article_id}}</td>
			<td>{{$v->article_name}}</td>
			<td>{{$v->article_parent}}</td>
			<td>{{$v->show}}</td>
			<td>{{$v->is_show}}</td>
			
			<td>{{$v->addtime}}</td>
			<td>
				<a href="{{url('/article/edit',['article_id'=>$v->article_id])}}">编辑</a>
				<!-- <a href="{{url('/article/del',['article_id'=>$v->article_id])}}">删除</a> -->
				<a href="javascript:void(0);" id="{{$v->article_id}}" class="del">删除</a>
			</td>
		</tr>
		@endforeach
		@endif
	</table>
	{{$data->appends($query)->links()}}
</body>
</html>
<script>
	$('.del').click(function(){
		// alert(0);
		var article_id=$(this).attr('id');
		// alert('article_id');
		if(!article_id){
			alert('选择一条');
		}
		 $.ajaxSetup({
      		 headers: {
       		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      		 }
     		 });		

		$.post('/article/del/'+article_id,'',function(msg){
			// alert(111);
			alert(msg.msg);
			window.location.reload();
		});

	});
</script>