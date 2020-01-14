@extends('layouts/admin')

@section('title', '带参数的二维码 -- 添加')

@section('content')
    <h3>带参数的二维码 -- 添加</h3>
    <form action="{{url('ticket/add_do')}}" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">推送方式</label>
    <input type="text" name="channel_name" class="form-control" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">推送编号</label>
    <input type="text" name="channel_status" class="form-control" id="exampleInputPassword1">
  </div>
  <button type="submit" class="btn btn-default">添加</button>
</form>
@endsection