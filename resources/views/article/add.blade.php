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
    <form action="/article/add_do" method="post" enctype="multipart/form-data">
        <meta name="csrf-token" content="{{ csrf_token() }}">
      @csrf

      <table>
          <tr>
            <td>文章标题</td>
            <td> 
              <input type="text" class="article_name" name="article_name" placeholder="请输入文章标题">
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
               <input type="radio" class="show" name="show" value="普通" title="普通">普通
               <input type="radio" class="show" name="show" value="置顶" title="置顶" checked>置顶
            </td>
           
          </tr>
           
           <tr>
            <td>是否显示</td>
            <td>
               <input type="radio" class="is_show" name="is_show" value="√">是
               <input type="radio" class="is_show" name="is_show" value="×" checked>否
            </td>
           
          </tr>
          <tr>
            <td>文章作者</td>
            <td> <input type="text" class="article_author" name="article_author" placeholder="请输入文章作者"></td>

          </tr> 
          <tr>
                <td>作者email</td>
                <td><input type="text" class="article_email" name="article_email"></td>
            </tr>
           <tr>
            <td>关键字</td>
            <td> <input type="text" class="article_keyword" name="article_keyword"></td>

          </tr>
        
           
          <tr>
            <td>描述</td>
            <td>
              <textarea name="article_desc" class="article_desc" placeholder="请输入描述"></textarea>
            </td>
          </tr>
          <tr>
                <td>上传文件</td>
                <td><input type="file" name="article_logo"></td>
            </tr>

           <tr>
            <td>
              
              <input type="submit" class="btn_ok btn_yes" value="提交">
            </td>
            
           
          </tr>
      </table>
    </form>
</body>
</html>

<script>
   $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
    $('input[name=article_name]').blur(function(){
     

      var article_name=$(this).val();
      if(article_name==''){
        alert('文章标题不能空');
        return;
      }
      var reg=/^[\u4e00-\u9fa5\w]{3,30}$/;
      if(!reg.test(article_name)){
        alert('文章标题格式为中文字母数字下划线3-30位');
        return;
      }

        $.post(
          '/article/checkName',{article_name:article_name},function(msg){
            if(msg.count){
              alert('文章标题已存在');
            }
        },'json');
      

      })
      $('.article_desc').blur(function(){
          var article_desc=$(this).val();
          // alert();
          if(article_desc==''){
            alert('文章描述不能空');
            return;
      }
      });


      $('.btn_yes').click(function(){
        var obj_html = $('input[name=article_name]');
        var article_name=obj_html.val();
        
        if(article_name==''){
          alert('文章标题不能空');
          return false;

        }
        var reg=/^[\u4e00-\u9fa5\w]{3,30}$/;
        if(!reg.test(article_name)){
           alert('文章标题格式为中文字母数字下划线3-30位');
        return false;
      }
       var desc_html=$('textarea[name=article_desc]');
       var article_desc=desc_html.val();
       if(article_desc==''){
          alert('文章描述不能空');
          return false;
       }
       var flag=false;
       $.ajax({
        method: "post",
        url: "/article/checkName",
        dataType:'json',
        async:false,
        data:{article_name:article_name}
        }).done(function(msg){
        if(msg.count){
          alert('文章标题已存在');
          flag=false;
          
          }else{
          flag=true;

          }
       });
        if(flag!=true){
           return flag;
       }
       // alert('011');
    

      });
      



 
</script>

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