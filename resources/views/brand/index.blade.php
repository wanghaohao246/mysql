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
<h3>商品列表</h3></hr>
<form action="">
    <input type="text" name="name" value="{{$name}}" placeholder="请输入商品">
    <input type="text" name="huohao" value="{{$huohao}}" placeholder="请输入货号">
    <input type="submit" value="搜索">
</form>
<table class="table">
    <caption>上下文表格布局</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>商品名称</th>
            <th>商品货号</th>
            <th>商品价格</th>
            <th>商品分类</th>
            <th>品牌</th>
            <th>商品缩略图</th>
            <th>商品库存</th>
            <th>是否精品</th>
            <th>是否热销</th>
            <th>商品详情</th>
            <th>相册</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $k=>$v)
        <tr @if($k%2==0) class="active" @else class="success" @endif>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->huohao}}</td>
            <td>{{$v->price}}</td>
            <td>{{$v->t_name}}</td>
            <td>{{$v->b_name}}</td>
            <td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50" height="50">@endif</td>
            <td>{{$v->num}}</td>
            <td>{{$v->is_jp==1?'是':'否'}}</td>
            <td>{{$v->is_rx==1?'是':'否'}}</td>
            <td>{{$v->desc}}</td>
            <td>
                @if($v->imgs)
                @php $photos = explode('|',$v->imgs);@endphp
                @foreach($photos as $vv)
                <img src="{{env('UPLOAD_URL')}}{{$vv}}" width="50" height="50">
                @endforeach
                @endif
            </td>
            <td><a href="{{url('bianji/'.$v->id)}}" class="btn btn-info">编辑</a>  |  
                <a href="{{url('delete/'.$v->id)}}" class="btn btn-danger">删除</a></td>
        </tr>
        @endforeach
        <tr>
            <td colspan="7">{{$data->appends(['name'=>$name,'huohao'=>$huohao])->links()}}</td>
        </tr>
    </tbody>
</table>
</body>
</html>