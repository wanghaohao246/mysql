<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>文章</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h3>文章</h3></hr>
<!-- @if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form class="form-horizontal" role="form" action="{{url('/WZ/store')}}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">标题</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="title" placeholder="请输入标题">
            <b style="color:blue">{{$errors->first('title')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章分类</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="fenlei">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章重要性</label>
        <div class="col-sm-2">
            <input type="radio" id="firstname" value="1" name="zyx" checked>普通
            <input type="radio" id="firstname" value="2" name="zyx">置顶
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-2">
            <input type="radio" id="firstname" value="1" name="is_xs" checked>显示
            <input type="radio" id="firstname" value="2" name="is_xs">不显示
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章作者</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="zuozhe">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">作者email</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="email">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">关键字</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="gjz">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">网页描述</label>
        <div class="col-sm-2">
            <textarea name="desc" id="" cols="30" rows="5"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">上传文件</label>
        <div class="col-sm-2">
            <input type="file" id="firstname" name="img">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="button" class="btn btn-default" value="确定">
        </div>
    </div>
</form>

</body>
</html>
<script src="/static/js/jquery.min.js"></script>
<script>
// $.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$('input[type="button"]').click(function(){
    var titleflag = true;
    $('input[name="title"]').next().html('');
    //标题验证
    var title = $('input[name="title"]').val();
    var reg =/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
    if(!reg.test(title)){
        $('input[name="title"]').next().html('文章标题由中文字母数字组成且不能为空');
        return;
    }
    //验证唯一性
    $.ajax({
        type:'post',
        url:"/news/checkOnly",
        data:{title:title},
        async:false,
        dataType:'json',
        success:function(result){
            if(result.count>0){
                $('input[name="title"]').next().html('标题已存在');
                titleflag = false;
            }
        }
    });
    if(!titleflag){
        return;
    }
    //作者验证
    var zuozhe = $('input[name="zuozhe"]').val();
    var reg = /^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
    if(!reg.test(zuozhe)){
        $('input[name="zuozhe"]').next().html('文章由中文字母数字组成且不能为空长度为2-8位');
        return;
    }
    //form提交
    $('form').submit();
});
    $('input[name="zuozhe"]').blur(function(){
        $(this).next().html('');
        var zuozhe = $(this).val();
        // alert(zuozhe);
        var reg = /^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
        // alert(reg);
        if(!reg.test(zuozhe)){
            $(this).next().html('文章作者由中文字母数字组成且不能为空长度为2-8位');
            return;
        }
    })

    $('input[name="title"]').blur(function(){
        $(this).next().html('');
        var title = $(this).val();
        var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;
        // alert(reg);
        if(!reg.test(title)){
            $(this).next().html('文章标题由中文字母数字组成且不为空');
            return;
        }
        $.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        //验证唯一性
        $.ajax({
            type:'post',
            url:"/news/checkOnly",
            data:{title:title},
            dataType:'json',
            success:function(result){
                if(result.count>0){
                    $('input[name="title"]').next().html('标题已存在');
                }
            }
        });
    })
</script>