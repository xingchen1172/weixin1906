<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <form class="form-horizontal" action="{{url('index/upd_do/'.$data->new_id)}}" method="post"> 
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputEmail3" placeholder="新闻标题" name="new_title" value="{{$data->new_title}}">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">内容</label>
            <div class="col-sm-10">
                <textarea name="new_desc" id="inputPassword3" cols="30" rows="10" placeholder="新闻内容" class="form-control">{{$data->new_desc}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">作者</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputPassword3" name="new_zuozhe" placeholder="作者" value="{{$data->new_zuozhe}}">
            </div>
          </div>
          <div class="form-group">
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">修改</button>
            </div>
          </div>
        </form>
</body>
</html>