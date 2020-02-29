<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h3>外来人口列表</h3></hr>
<form action="">
    <input type="text" name="p_name" value="{{$p_name}}" placeholder="请输入用户名">
    <input type="submit" value="搜索">
</form>
<table class="table">
    <caption>上下文表格布局</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>年龄</th>
            <th>头像</th>
            <th>是否湖北人</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $k=>$v)
        <tr @if($k%2==0) class="active" @else class="success" @endif>
            <td>{{$v->p_id}}</td>
            <td>{{$v->p_name}}</td>
            <td>{{$v->age}}</td>
            <td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50" height="50">@endif</td>
            <td>{{$v->is_hubei==1?'是':'否'}}</td>
            <td>{{date("Y-m-d H:i:s",$v->add_time)}}</td>
            <td><a href="{{url('edit/'.$v->p_id)}}" class="btn btn-info">编辑</a>  |  
                <a href="{{url('del/'.$v->p_id)}}" class="btn btn-danger">删除</a></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7">{{$data->appends(['p_name'=>$p_name])->links()}}</td>
        </tr>
    </tbody>
</table>
</body>
</html>