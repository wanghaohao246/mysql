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
 <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;商品信息修改表</h2></hr>
<form class="form-horizontal" role="form" action="{{url('/xiugai/'.$data->id)}}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="name" value="{{$data->name}}">
            <b style="color:blue">{{$errors->first('name')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="price" value="{{$data->price}}">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类</label>
        <div class="col-sm-2">
        <select name="t_id" id="" class="form-control" id="firstname">
            <option value="0">----</option>
            @foreach($res as $k=>$v)
            <option value="{{$v->t_id}}">{{str_repeat('——',$v->level)}}{{$v->t_name}}</option>
            @endforeach
        </select>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌</label>
        <div class="col-sm-2">
        <select name="b_id" id="" class="form-control" id="firstname">
            <option value="0">----</option>
            @foreach($re as $k=>$v)
            <option value="{{$v->b_id}}">{{$v->b_name}}</option>
            @endforeach
        </select>
        </div>
    </div>

     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">缩略图</label>
        <div class="col-sm-2">
            <input type="file" id="firstname"  name="img">
            <img src="{{env('UPLOAD_URL')}}{{$data->img}}" width="50" height="50">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="num" value="{{$data->num}}">
        </div>
    </div>

     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否精品</label>
        <div class="col-sm-2">
            <input type="radio" id="firstname" value="1" name="is_jp"  @if($data->is_jp==1) checked @endif>是
            <input type="radio" id="firstname" value="2" name="is_jp"  @if($data->is_jp==2) checked @endif>否
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否热销</label>
        <div class="col-sm-2">
            <input type="radio" id="firstname" value="1" name="is_rx"  @if($data->is_rx==1) checked @endif>是
            <input type="radio" id="firstname" value="2" name="is_rx"  @if($data->is_rx==2) checked @endif>否
        </div>
    </div>
    
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品详情</label>
        <div class="col-sm-2">
            <textarea name="desc" id="" cols="30" rows="2">{{$data->desc}}</textarea> 
        </div>
    </div>
     <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">相册</label>
        <div class="col-sm-2">
            <input type="file" id="firstname"  name="imgs[]" multiple="multiple">
            @if($data->imgs)
                @php $photos = explode('|',$data->imgs);@endphp
                @foreach($photos as $vv)
                <img src="{{env('UPLOAD_URL')}}{{$vv}}" width="50" height="50">
                @endforeach
                @endif
        </div>
    </div>
   
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="button" value="修改">
        </div>
    </div>
</form>

</body>
</html>
<script src="/static/js/jquery.min.js"></script>
<script>
// alert('123');
// $.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$('input[type="button"]').click(function(){
    var titleflag = true;
    $('input[name="name"]').next().html('');
    //商品名称验证
    var name = $('input[name="name"]').val();
    var reg =/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
    if(!reg.test(name)){
        $('input[name="name"]').next().html('商品名称由中文字母数字组成且不能为空');
        return;
    }
    //验证唯一性
    $.ajax({
        type:'post',
        url:"/new/checkOnly",
        data:{name:name},
        async:false,
        dataType:'json',
        success:function(result){
            if(result.count>0){
                $('input[name="name"]').next().html('商品已存在');
                titleflag = false;
            }
        }
    });
    if(!titleflag){
        return;
    }
    //作者验证
    var huohao = $('input[name="huohao"]').val();
    var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;
    if(!reg.test(huohao)){
        $('input[name="huohao"]').next().html('货号由中文字母数字组成且不能为空');
        return;
    }
    //form提交
    $('form').submit();
});
    $('input[name="huohao"]').blur(function(){
        $(this).next().html('');
        var huohao = $(this).val();
        // alert(huohao);
        var reg = /^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
        // alert(reg);
        if(!reg.test(huohao)){
            $(this).next().html('货号由中文字母数字组成且不能为空');
            return;
        }
    })

    $('input[name="name"]').blur(function(){
        $(this).next().html('');
        var name = $(this).val();
        var reg = /^[\u4e00-\u9fa50-9A-Za-z_]+$/;
        // alert(reg);
        if(!reg.test(name)){
            $(this).next().html('商品名称由中文字母数字组成且不为空');
            return;
        }
        $.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        //验证唯一性
        $.ajax({
            type:'post',
            url:"/new/checkOnly",
            data:{name:name},
            dataType:'json',
            success:function(result){
                if(result.count>0){
                    $('input[name="name"]').next().html('商品已存在');
                }
            }
        });
    })
</script>