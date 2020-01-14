<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('index/save')}}" method="post">
    <h1>首页</h1>
    <table border="1">
    @csrf
        <tr>
            <td>
                名称
            </td>
            <td>
                <input type="text" name="username">
            </td>
        </tr>
        <tr>
            <td>
                密码
            </td>
            <td>
                <input type="password" name="pwd">
            </td>
        </tr>
        <tr>
            <td>
                确认密码
            </td>
            <td>
                <input type="password" name="pwd1">
            </td>
        </tr>
        <tr>
            <td>
                
            </td>
            <td><input type="submit" value="提交"></td>
        </tr>
    </table>

    </form>
</body>
</html>