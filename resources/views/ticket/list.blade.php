@extends('layouts/admin')

@section('title', '素材管理 -- 添加')

@section('content')

<table class="table table-striped">
  <tr>
      <td>顺序</td>
      <td>推广方式</td>
      <td>推广编号</td>
      <td>二维码</td>
      <td>操作</td>
  </tr>
  @foreach($data as $v)
  <tr>
      <td>{{$v->channel_id}}</td>
      <td>{{$v->channel_name}}</td>
      <td>{{$v->channel_status}}</td>
        <td>    
            <img src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={{$v->ticket}}" style="height:100px">
        </td>
      <td>
            <a href="">删除</a>
            <a href="">修改</a>
      </td>
  </tr>
  @endforeach
</table>
{{$data->links()}}

@endsection