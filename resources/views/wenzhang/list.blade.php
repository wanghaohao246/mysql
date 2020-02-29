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
<h3>文章列表</h3></hr>
<form action="">
    <input type="text" name="title" value="{{$title}}" placeholder="请输入标题">
    <input type="text" name="fenlei" value="{{$fenlei}}" placeholder="请输入分类">
    <input type="submit" value="搜索">
</form>
<table class="table">
    <caption>上下文表格布局</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>标题</th>
            <th>分类</th>
            <th>重要性</th>
            <th>是否显示</th>
            <th>作者</th>
            <th>作者email</th>
            <th>关键字</th>
            <th>网页描述</th>
            <th>文件图</th>
            <th>添加日期</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $k=>$v)
        <tr @if($k%2==0) class="active" @else class="success" @endif>
            <td>{{$v->id}}</td>
            <td>{{$v->title}}</td>
            <td>{{$v->fenlei}}</td>
            <td>{{$v->zyx==1?'普通':'置顶'}}</td>
            <td>{{$v->is_xs==1?'√':'×'}}</td>
            <td>{{$v->zuozhe}}</td>
            <td>{{$v->email}}</td>
            <td>{{$v->gjz}}</td>
            <td>{{$v->desc}}</td>
            <td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50" height="50">@endif</td>
            <td>{{date("Y-m-d H:i:s",$v->add_time)}}</td>
            <td><a href="{{url('/WZ/edit/'.$v->id)}}" class="btn btn-info">编辑</a>  |  
                <a href="javascript:void(0)" onclick="del({{$v->id}})">删除</a></td></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7">{{$data->appends(['title'=>$title,'fenlei'=>$fenlei])->links()}}</td>
        </tr>
    </tbody>
</table>
<script src="/static/js/jquery.min.js"></script>
<script>
    function del(id){
        if(!id){
            return;
        }
        if(confirm('是否要删除此条记录')){
            //ajax删除
            $.get('/WZ/del/'+id,function(result){
                if(result.code=='00000'){
                    location.reload();
                }
            },'json')
        }
    }
</script>
</body>
</html>