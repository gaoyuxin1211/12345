<!DOCTYPE html>
<html>
<head>
  <title>文章</title>
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
    <form action="/article/update/{{$data->article_id}}" method="post" enctype="multipart/form-data">
        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
      @csrf

      <table>
          <tr>
            <td>文章标题</td>
            <td> 
              <input type="text" class="article_name" name="article_name" placeholder="请输入文章标题" value="{{$data->article_name??''}}">
            </td>

          </tr>
          <tr>
            <td>父级分类</td>
            <td>
              <select name="article_parent" class="article_parent">
                <option value="0">请选择</option>
                
               
                <option value="核电建设大厦">核电建设大厦</option>
                <option value="龙龙有限公司">龙龙有限公司</option>
              
             
                
              </select>
            </td>
           
          </tr>
          <tr>
            <td>文章重要性</td>
            <td>
               <input type="radio" class="show" name="show" value="普通" title="普通" {{$data->show=='普通'?'checked':''}}>普通
               <input type="radio" class="show" name="show" value="置顶" title="置顶" {{$data->show=='置顶'?'checked':''}}>置顶
            </td>
           
          </tr>
           
           <tr>
            <td>是否显示</td>
            <td>
               <input type="radio" class="is_show" name="is_show" value="√" {{$data->is_show=='√'?'checked':''}}>是
               <input type="radio" class="is_show" name="is_show" value="×" {{$data->is_show=='×'?'checked':''}}>否
            </td>
           
          </tr>
          <tr>
            <td>文章作者</td>
            <td> <input type="text" class="article_author" name="article_author" placeholder="请输入文章作者" value="{{$data->article_author}}"></td>

          </tr> 
          <tr>
                <td>作者email</td>
                <td><input type="text" class="article_email" name="article_email" value="{{$data->article_email}}"></td>
            </tr>
           <tr>
            <td>关键字</td>
            <td> <input type="text" class="article_keyword" name="article_keyword" value="{{$data->article_keyword}}"></td>

          </tr>
        
           
          <tr>
            <td>描述</td>
            <td>
              <textarea name="article_desc" class="article_desc" placeholder="请输入描述" value="">{{$data->article_desc}}</textarea>
            </td>
          </tr>
          <tr>
                <td>上传文件</td>
                <td><input type="file" name="article_logo"></td>
            </tr>
            <!-- <input type="hidden" name="article_id" value="{{$data->article_id}}"> -->
           <tr>
            <td>
              <button class="btn_ok btn_yes">提交</button>
            </td>
            
           
          </tr>
      </table>
    </form>
</body>
</html>



<!-- <script type="text/javascript">
  $(function(){
    $('.btn_yes').click(function(){
      // alert(0);
      var article_name=$('.article_name').val();
      var article_parent=$('.article_parent').val();
      var show=$('.show:checked').val();
      var is_show=$('.is_show:checked').val();
      // alert(is_show);
      var article_author=$('.article_author').val();
      var article_email=$('.article_email').val();
      var article_keyword=$('.article_keyword').val();
      var article_desc=$('.article_desc').val();
      // var _token=$('input:hidden').val();
      // alert(show);
      $.ajaxSetup({
       headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
      });


          // // console_log();
          // alert(_token);
       $.post(
            '/article/add_do',
            {article_name:article_name,show:show,is_show:is_show,article_author:article_author,article_email:article_email,article_keyword:article_keyword,article_desc:article_desc},
            function(res){
              // console.log(res);
              if(res==1){
               location.href="{{url('/article/list')}}";
              }
            }

        ); 
        return false;
    })
  });
</script>

 -->