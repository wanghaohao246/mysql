<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员表</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center>
<div class="table-responsive">
 
  <table class="table">
    <thead>
      <tr>
        <th>用户名</th>
        <th>主管|管理员</th>
     
        <td>操作</td>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
      <tr>
        <td>{{$v->u_name}}</td>
        <td>{{$v->is_sf==1?'管理员':'主管'}}</td>
       
        <td><a href="{{url('n/creates/')}}" class="btn btn-info">添加</a> <a href="{{url('n/troy/'.$v->u_id)}}" class="btn btn-danger">删除</a></td>
      </tr>
    @endforeach
     
    </tbody>
  </table>
</div>
</center>
</body>
</html>
