<html>
<head>
    <title>用户</title>
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
    <form action="/admin/add_do" method="post" enctype="multipart/form-data">
        @csrf

        <table>
            
            <tr>
                <td>用户名称</td>
                <td><input type="text" name="admin_name"></td>
            </tr>
             <tr>
                <td>密码</td>
                <td><input type="password" name="admin_pwd"></td>
            </tr>
             <tr>
                <td>确认密码</td>
                <td><input type="password" name="admin_repwd"></td>
            </tr>
             <tr>
                <td>用户邮箱</td>
                <td><input type="text" name="admin_email"></td>
            </tr>
             <tr>
                
                <td><button>提交</button></td>
            </tr>
        </table>
    </form>
</body>
</html>