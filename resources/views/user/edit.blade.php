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
<h3>外来人口编辑表</h3></hr>
<form class="form-horizontal" role="form" action="{{url('/update/'.$data->p_id)}}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="p_name" value="{{$data->p_name}}" placeholder="请输入名字">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">年龄</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="age" value="{{$data->age}}" placeholder="请输入年龄">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-2">
            <input type="file" id="firstname" value="{{$data->img}}" name="img">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname"  class="col-sm-2 control-label">是否湖北地方</label>
        <div class="col-sm-2">
            <input type="radio" id="firstname" value="1" name="is_hubei" @if($data->is_hubei==1) checked @endif>是
            <input type="radio" id="firstname" value="2" name="is_hubei"  @if($data->is_hubei==2) checked @endif>否
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