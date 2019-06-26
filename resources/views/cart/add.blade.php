<!DOCTYPE html>
<html>
<head>
  <title>分类的</title>
  <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
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
    <form>
        <meta name="csrf-token" content="{{ csrf_token() }}">


      <table border="1">
          <tr>
            <td>分类名称</td>
            <td> <input type="text" class="cate_name" name="cate_name" placeholder="请输入分类名称"></td>

          </tr>
           <tr>
            <td>是否显示</td>
            <td>
               <input type="radio" class="is_show" name="is_show" value="1" title="是">是
               <input type="radio" class="is_show" name="is_show" value="0" title="否" checked>否
            </td>
           
          </tr>
           
           
          </tr>
           <tr>
            <td>父级分类</td>
            <td>
              <select name="parent_id" class="parent_id">
                <option value="0">顶级分类</option>
                
                @foreach($data as $v)
              <option value="{{$v['cate_id']}}">
              {{str_repeat(" - ",$v['level']-1)}}{{$v['cate_name']}}
              </option>
              @endforeach
                
              </selis
            </td>
           
          </tr>
          <tr>
            <td>描述</td>
            <td>
              <textarea name="cate_desc" class="cate_desc" placeholder="请输入描述"></textarea>
            </td>
          </tr>
           <tr>
            <td>
              <button class="btn_ok btn_yes">提交</button>
            </td>
            
           
          </tr>
      </table>
    </form>
</body>
</html>



<script type="text/javascript">
  $(function(){
    $('.btn_yes').click(function(){
      // alert(0);
      var cate_name=$('.cate_name').val();
      var is_show=$('.is_show:checked').val();
      // alert(is_show);
      var cate_desc=$('.cate_desc').val();
      // var _token=$('input:hidden').val();
      $.ajaxSetup({
       headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
      });


          // // console_log();
          // alert(_token);
       $.post(
            '/cart/add_do',
            {cate_name:cate_name,is_show:is_show,cate_desc:cate_desc},
            function(res){
              // console.log(res);
              if(res==1){
               location.href="{{url('/cart/list')}}";
              }
            }

        ); 
        return false;
    })
  });
</script>

