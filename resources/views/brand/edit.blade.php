<!DOCTYPE html>
<html>
<head>
    <title>品牌的添加</title>
</head>
<body>
    <form action="/brand/add_do" method="post" >
        @csrf
        <table>
            <tr>
                <td>品牌名称</td>
                <td><input type="text" name="brand_name"></td>
            </tr>
             <tr>
                <td>品牌描述</td>
                <td><input type="text" name="brand_desc"></td>
            </tr>
             <tr>
                <td>品牌Logo</td>
                <td><input type="file" name="brand_logo"></td>
            </tr>
             <tr>
                <td>品牌网址</td>
                <td><input type="text" name="brand_url"></td>
            </tr>
             <tr>
                
                <td><button>提交</button></td>
            </tr>
        </table>
    </form>
</body>
</html>