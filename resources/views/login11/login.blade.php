    @extends('layouts.shop')
    @section('title', '会员登录')
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
     <form action="add" method="post" class="reg-login" id="tj1">
     <meta name="csrf-token" content="{{ csrf_token() }}">
      <h3>还没有三级分销账号？点此<a class="orange" href="/index/login/reg">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="u_phone" id="u_phone" placeholder="输入手机号码" /></div>
       <div class="lrList"><input type="text" name="u_pwd" id="u_pwd" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" value="立即登录" id="tj"/>
      </div>
     </form><!--reg-login/-->
    <script>

    $("#tj").click(function(){
          

      $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      var u_phone=$("#u_phone").val();
      var u_pwd=$("#u_pwd").val();
      //alert(u_pwd);

      
    })

    </script>

     @endsection