@extends('layouts/admin')

@section('title', '素材管理 -- 添加')

@section('content')

<form>
    <input type="text" name="title" value="{{$query['title']??''}}"  placeholder="新闻标题">
    <input type="text" name="zuozhe" value="{{$query['zuozhe']??''}}" placeholder="新闻作者">
    <input type="submit" value="搜索">
</form>
<div class="table-responsive">
    <table class="table" border="1">
      <tr>
          <td>新闻标题</td>
          <td>新闻内容</td>
          <td>作者</td>
          <td>访问量</td>
          <td>时间</td>
          <td>操作</td>
      </tr>
      @foreach($data as $v)
      <tr>
          <td>{{$v->new_title}}</td>
          <td>{{$v->new_desc}}</td>
          <td>{{$v->new_zuozhe}}</td>
          <td>{{$v->new_page}}</td>
          <td>{{$v->updated_at}}</td>
          <td>
            <a href="{{url('index/del/'.$v->new_id)}}">删除</a>
            <a href="{{url('index/upd/'.$v->new_id)}}">修改</a>
          </td>
      </tr>
      @endforeach
    </table>
</div>
{{$data->links()}}

@endsection