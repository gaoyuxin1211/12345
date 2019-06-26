<!DOCTYPE html>
<html>
<head>
  <title>货物</title>
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
    <form action="/huo/update/{{$data->huo_id}}" method="post" enctype="multipart/form-data">
        <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
      @csrf

      <table>
          <tr>
            <td>货物名称</td>
            <td> 
              <input type="text"  name="huo_name" placeholder="请输入货物名称" value="{{$data->huo_name??''}}">
            </td>

          </tr>
            <tr>
                <td>上传文件</td>
                <td><input type="file" name="huo_logo"></td>
            </tr>

           <tr>
         
          <tr>
            <td>库存</td>
            <td> <input type="text" name="huo_author" placeholder="请输入库存" value="{{$data->huo_author??''}}"></td>
          </tr> 
            <!-- <input type="hidden" name="huo_id" value="{{$data->huo_id}}"> -->
            <td>
              <button class="btn_ok btn_yes">修改</button>
            </td>
            
           
          </tr>
      </table>
    </form>
</body>
</html>