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
<h3>新闻列表</h3></hr>
<form action="">
    <input type="text" name="name" value="{{$name}}" placeholder="请输入标题">
    <!-- <input type="text" name="class" value="{{$class}}" placeholder="请输入班级"> -->
    <input type="submit" value="搜索">
</form>
<table class="table">
    <caption>上下文表格布局</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>新闻标题</th>
            <!-- <th>性别</th>
            <th>班级</th>
            <th>成绩</th> -->
            <th>新闻图片</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $k=>$v)
        <tr @if($k%2==0) class="active" @else class="success" @endif>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <!-- <td>{{$v->sex==1?'男':'女'}}</td>
            <td>{{$v->class}}</td>
            <td>{{$v->cj}}</td> -->
            <td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50" height="50">@endif</td>
            <td><a href="{{url('bj/'.$v->id)}}" class="btn btn-info">编辑</a>  |  
                <a href="{{url('de/'.$v->id)}}" class="btn btn-danger">删除</a></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7">{{$data->appends(['name'=>$name,'class'=>$class])->links()}}</td>
        </tr>
    </tbody>
</table>
</body>
</html>
<<script>
    $(document).on('click','.pagination a',function(){
        var url =$(this).attr(href);
        if(!url){
            return;
        }
        $.get(url,function(result){
            $('tbody').html(result);
        });
        return false;
    })
</script>