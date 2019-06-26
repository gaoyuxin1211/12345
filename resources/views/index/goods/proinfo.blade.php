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
       <h1>产品详情</h1>
      </div>
     </header>

     <div id="sliderA" class="slider"> 
      @foreach($data as $v)
      <img src="{{config('app.img_url')}}{{$v->goods_img}}" />
      @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
        @foreach($data as $v)
       <th><strong class="orange">{{$v->shop_price}}</strong></th>
       <td>
        <button id="jian">-</button>
        <input type="text" class="spinner" value="1" id="jj"/>
        <button id="jia">+</button>
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$v->goods_name}}</strong>
        <p class="hui">{{$v->description}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
       @endforeach
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="/index/images/image4.jpg" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="car.html">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    @include('public/footer');
    

     <!--jq加减-->
    <script src="js/jquery.spinner.js"></script>
   <script>
	    
       $(function () {
           // 点击加号 数量加一
           $('#jia').click(function(){
               var shuliang =  parseInt($('#jj').val());
               var num = shuliang+1;
               var kucun = $('#kucun').html();
               $('#jj').val(num);
               if (shuliang >= kucun) {
                   $('#jj').val(kucun);
               }
               newprice();
           })
           // 点击减号 数量减一
           $('#jian').click(function(){
               var shuliang =  parseInt($('#jj').val());
               var num = shuliang-1;
               $('#jj').val(num);


               if (shuliang <= 1) {
                   $('#jj').val(1);
               }
               newprice();
           })
        });
	</script>
  </body>
 @endsection