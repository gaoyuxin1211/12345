@extends('layouts.shop')
@section('title', '狗梦有限公司')
@section('content')


<script src="/index/js/jquery.excoloSlider.js"></script>
  <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="/index/add_do" method="post" class="reg-login">
        <meta name="csrf-token" content="{{ csrf_token() }}">
      @csrf
      <h3>已经有账号了？点此<a class="orange" href="/index/login">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="user_email" id="email" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2">
        <input type="text" name="user_code" id="user_code" class="user_code" placeholder="输入短信验证码" />
          <a class="btn" href="javascript:void(0);" id="sendEmailCode">
              <span style=color:red;font-size:20px; id="span_email">获取</span>
          </a>
       </div>
       <div class="lrList"><input type="text" name="user_pwd" id="user_pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text" name="user_pwd1" id="user_pwd1" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" id="btn" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <div class="height1"></div>
     @include('public/footer');
<script>
  $('#email').blur(function(){
    // alert(22222);
    var user_email=$(this).val();
    var reg=/^\w+@\w+\.com$/;
     var flag=false;

     if(user_email==''){
      alert('邮箱不能空');
      return false;
    }else if(!reg.test(user_email)){
      alert('邮箱格式不对');
      return false;
    }

     $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

        var flag=false;
       $.ajax({
        method: "post",
        url: "/index/checkName",
        dataType:'json',
        async:false,
        data:{user_email:user_email}
        }).done(function(msg){
        if(msg.count){
          alert('邮箱已存在');
          flag=false;
          
          }else{
          flag=true;

          }
       });
        if(flag!=true){
           return flag;
       }
  });
  $('#btn').click(function(){
     
        // alert(111);
    var user_email=$('#email').val();
    var user_pwd=$('#user_pwd').val();
    var user_pwd1=$('#user_pwd1').val();
    var user_code=$('#user_code').val();
    var reg=/^\w+@\w+\.com$/;
    var flag=false;

    if(user_email==''){
      alert('邮箱不能空');
      return false;
    }else if(!reg.test(user_email)){
      alert('邮箱格式不对');
      return false;
    }else if(user_pwd==''){
      alert('密码不能空');
      return false;
    }else if(user_pwd1==''){
      alert('确认密码不能空');
      return false;
    }else if(user_pwd != user_pwd1){
      alert('两次密码不一致');
      return false;
    }else if(user_code==''){
      alert('验证码不能空');
      return false;
    }

     $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

        var flag=false;
       $.ajax({
        method: "post",
        url: "/index/checkName",
        dataType:'json',
        async:false,
        data:{user_email:user_email}
        }).done(function(msg){
        if(msg.count){
          alert('邮箱已存在');
          flag=false;
          
          }else{
          flag=true;

          }
       });
        if(flag!=true){
           return flag;
       }

    
      //把邮箱传给控制器  控制器发送邮件
        $.post(
          "{{url('/index/sendemail')}}",
          {user_email:user_email},
          function(res){
            // console.log(res);
            if(res.code==1){
              alert(res.count);
            }else{
              alert(res.count);
            }
          },
          'json'
        );

      
  });

</script>
      @endsection

    
