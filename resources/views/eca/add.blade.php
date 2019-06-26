<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if ($errors->any())
 <div class="alert alert-danger">
 <ul>
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
@endif
	 <form action="/eca/add_do" method="post" enctype="multipart/form-data">
        @csrf
        <h3>hhh</h3>
	<table>
		<tr>
			<td>用户姓名：</td>
			<td>
				<input type="text" name="eca_name">
			</td>
		</tr>
		<tr>
			<td>用户身份证：</td>
			<td>
				<input type="text" name="eca_age">
			</td>
		</tr>
		<div class="lrList">
        <select class="changearea" id="province">
         <option value="0" selected="selected">--请选择省市--</option>
         @if($provinceInfo)
         @foreach($provinceInfo as $v)
            <option value="{{$v->id}}">{{$v->name}}</option>
         @endforeach
         @endif
        </select>
       </div>
      
       <div class="lrList">
        <select class="changearea" id="city">
         <option value="0" selected="selected">--请选择市--</option>
        </select>
       </div>
       <div class="lrList">
        <select class="changearea" id="area">
         <option value="0" selected="selected">--请选择县区--</option>
        </select>
       </div>
		<tr>
			 <td>
              
              <input type="submit" class="btn_ok btn_yes" value="提交">
            </td>
            
           
		</tr>
	</table>
</form>
</body>
</html>
<script src="/index/js/jquery.min.js"></script>
<script>
  $(function(){


    //内容改变
    $('.changearea').change(function() {
      var _this=$(this);
      // _this.nextAll('select').html("<option value='0'>--请选择--</option>");
      var id=_this.val();
      // console.log(id);
      $.post(
        "{{url('/eca/getArea')}}",
        {id:id},
        function(res){
          // console.log(res);
          var _option="<option value='0'>--请选择--</option>";
          for (var i = 0;i<res.length; i++) {
            _option+="<option value='"+res[i]['id']+"'>"+res[i]['name']+"</option>"
          }
          // console.log(_option);
          // _this.next('select').html(_option);
          _this.parent("div[class='lrList']").next("div").children('select').html(_option);
        },
        'json'
      );
    })

  });
</script>