@extends('layouts.shop')
@section('title', '狗梦有限公司')
@section('content')

<script src="/index/js/jquery.excoloSlider.js"></script>
  <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="images/head.jpg" />
     </div><!--head-top/-->
     <form action="/index/aaa_do" method="post" class="reg-login">
       <meta name="csrf-token" content="{{ csrf_token() }}">
      @csrf
      <h3>还没有三级分销账号？点此<a class="orange" href="reg.html">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" class="user_email" name="user_email" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="text" class="user_pwd" name="user_pwd" placeholder="输入证码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" class="btn_ok btn_yes" value="立即登录" />
      </div>
     </form><!--reg-login/-->
 @include('public/footer');
 <script type="text/javascript">
  $(function(){
    $('.btn_yes').click(function(){
      // alert(0);
      var user_email=$('.user_email').val();
      var user_pwd=$('.user_pwd').val();
      // alert(user_email);
      
    
      $.ajaxSetup({
       headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
      });


         
       $.post(
            '/index/aaa_do',
            {user_email:user_email,user_pwd:user_pwd},
            function(res){
              // console.log(res);
              if(res.code==1){
               location.href="{{url('/')}}";
              }
            },
            'json'
        ); 
        return false;
    })
  });
</script>


      @endsection
