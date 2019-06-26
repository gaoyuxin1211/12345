    @extends('layouts.shop')
    @section('title', '会员注册')
    @section('content')
    
<script type="text/javascript" src="/admin/js/jquery.min.js"></script>
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />

     </div><!--head-top/-->
     <form action="add" method="post" class="reg-login" id="tj">
     <meta name="csrf-token" content="{{ csrf_token() }}">
      <h3>已经有账号了？点此<a class="orange" href="/index/login/login">登陆</a></h3>

      <div class="lrBox">
       <div class="lrList"><input type="text" id="p" name="u_phone" placeholder="输入手机号码或者邮箱号" /></div><span class="span1"></span>
       <div class="lrList2"><input type="text" placeholder="输入短信验证码" id="sss"/> <a id="send">获取验证码</a></div><span id="s"></span>
       <div class="lrList"><input type="text" name="u_pwd" id="p1" placeholder="设置新密码（6-18位数字或字母）" /></div><span class="span"></span>
       <div class="lrList"><input type="text" name="u_pwd1" id="p2" placeholder="再次输入密码" /></div><span class="span"></span>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" value="立即注册" id="tj1"/>
      </div>
     </form><!--reg-login/-->
    <script>
    $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      $("#send").click(function(){
         var u_phone=$("#p").val();
         alert('验证码发送成功,请查看手机短信');
        //alert(u_phone);
        $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
        $.post(
          "{{url('index/login/send')}}",
          {u_phone:u_phone},
          function(msg){
            //console.log(msg);
          }
          )

      })

      $("#sss").blur(function(){
        var value=$(this).val();
        //alert(value);
        $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
        $.post(
          "{{url('index/login/ss')}}",
          {value:value},
          function(msg){
           // console.log(msg);
          if (msg.code!=1) {
            alert('验证码错误');
            return;
          };
          }
          )
      })

     $("#p").blur(function(){
      var phone=$(this).val();

      //alert(phone);
       if (phone=='') {
      //alert('不一致');
      $(".span1").html('<i style="color:red"> * 手机号或者邮箱不能为空 ! !</i>');
      return;
      };
      var phone=$("#p").val();
      $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      //alert(phone);
      $.post(
          "{{url('index/login/checkName')}}",{phone:phone},function(msg){
            if(msg.count){
              //alert('品牌名称已存在');
              $(".span1").html('<i style="color:red"> * 手机号或者邮箱已存在 ! !</i>');
              return;
            }else{
              $(".span1").hide();
            }
        },'json');
     })
     $('#p2').blur(function(){
     // alert(1);
     var u_pwd=$("#p1").val();
     //alert(u_pwd);
     var u_pwd1=$("#p2").val();
     if (u_pwd!=u_pwd1) {
      //alert('不一致');
      $(".span").html('<i style="color:red"> * 两次密码不一致 ! !</i>');
      return;
     }else{
      $(".span").hide();
     }
     });

     

     $("#tj1").click(function(){
      var u_phone=$('#p').val();
      var u_pwd=$('#p1').val();
       $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      //alert(phone);
      var fd= new FormData($("#tj")[0]);
      //console.log(fd);
      $.ajax({
        method: "post",
        url: "/index/login/add",
        dataType:'json',
        async:true,
        data:fd,
        processData:false,
        contentType:false,
        }).done(function(msg){
          if (msg.code==1) {
            alert('注册成功,跳转到登录页面');
           location.href='{{url("index/login/login")}}';
          };
       });
     //$("#tj").submit();
     })
     

    </script>

     @endsection