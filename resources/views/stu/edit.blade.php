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
<h3>学生编辑表</h3></hr>
<form class="form-horizontal" role="form" action="{{url('/xg/'.$data->id)}}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="name" value="{{$data->name}}" placeholder="请输入名字">
            <b style="color:red">{{$errors->first('name')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname"  class="col-sm-2 control-label">性别</label>
        <div class="col-sm-2">
            <input type="radio" id="firstname" value="1" name="sex" @if($data->sex==1) checked @endif>男
            <input type="radio" id="firstname" value="2" name="sex"  @if($data->sex==2) checked @endif>女
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">班级</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="class" value="{{$data->class}}" >
        </div>
    </div>
    
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">成绩</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="cj" value="{{$data->cj}}" placeholder="请输入成绩">
            <b style="color:red">{{$errors->first('cj')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-2">
            <input type="file" id="firstname"  name="img" value="{{$data->img}}">
            <img src="{{env('UPLOAD_URL')}}{{$data->img}}" width="50" height="50">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">修改</button>
        </div>
    </div>
</form>

</body>
</html>