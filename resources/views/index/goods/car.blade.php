@extends('layouts.shop')
@section('title', '狗梦有限公司')
@section('content')
<script src="/index/js/jquery.excoloSlider.js"></script>
<script type="text/javascript" src="/index/js/jquery-1.7.2.min.js"></script>
  
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">2</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     <table>
     <tr>
        <td width="100%" colspan="4">
          <a href="javascript:;"><input type="checkbox"  id="allbox" /> 全选</a></td>
       </tr>
       </table>
     <div class="dingdanlist">
     @if($data)
      @foreach($data as $v)
      <table>
       
      
       <tr>

        <td width="4%"><input type="checkbox" class="box" /></td>
        <td class="dingimg" width="15%"><img src="http://upload.1811.com/{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：2015-08-11  13:51</time>
         <th colspan="4"><strong class="orange">¥{{$v->shop_price}}</strong></th>
        </td>
         <td>
            <button id="jian">-</button>
            <input type="text" class="spinner" value="1" id="jj" width="30"/>
            <button id="jia">+</button>
         </td>   
         
       </tr>
      

       @endforeach
       @endif
      </table>
     </div><!--dingdanlist/-->
   
       
     
    
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">¥69.88</strong></td>
       <td width="40%"><a href="pay.html" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
      
      
     </div><!--prolist/-->
      <!-- @include('public/footer'); -->

    <!--焦点轮换-->
    <script src="/index/js/jquery.excoloSlider.js"></script>
    <script>
      $(function () {
          $('#allbox').click(function(){
            // alert(111111);
              var status=$(this).prop('checked');
              $('.box').prop('checked',status);
          })

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

  @endsection