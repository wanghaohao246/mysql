<?php

namespace App\Http\Controllers;
use App\Wenzhangs;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Wenzhang extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //搜索
        $title=request()->title??'';
        $fenlei=request()->fenlei??'';
        $where = [];
        if($title){
            $where[] =['title','like',"%$title%"];
        }
         if($fenlei){
            $where[] =['fenlei','like',"%$fenlei%"];
        }
        //分页
        $pageSize = config('app.pageSize');
        $data=Wenzhangs::where($where)->orderby('id','desc')->paginate($pageSize);
       return view('wenzhang.list',['data'=>$data,'title'=>$title,'fenlei'=>$fenlei]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wenzhang.wenzhang');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //第一种验证
        $request->validate([
                'title'=>['required','unique:wenzhang','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,12}+$/u
'],
                'fenlei'=>['required'],
                'zyx'=>['required'],
                'is_xs'=>['required'],
                
            ],[
                'title.required'=>'标题不能为空',
                'title.regex'=>'标题必须是中文，字母，下划线，数字组成',
                'title.unique'=>'标题已存在',
                'fenlei.required'=>'分类不能为空',
                'zyx.required'=>'重要性不能为空',
                'is_xs.required'=>'显示不能为空',
            ]);
        $data = $request->except('_token');
        // dd($data);
        //文件上传
        if($request->hasFile('img')){
            $data['img'] = $this->upload('img');
            // dd($img); 
        }
        $data['add_time'] = time();
        //ORM操作
        $Wenzhangs=new Wenzhangs;
        $res=$Wenzhangs->create($data);
        if($res){
            return redirect('/WZ/list');
        }
    }

    //上传文件
    public function upload($filename){
        //判断上传过程中有无错误
        if(request()->file($filename)->isValid()){
            //接收值
            $photo = request()->file($filename);
            //上传
            $store_result = $photo->store('uploads');
            return $store_result;
        }
        exit('未获取上传文件或上传文件过程出错');
    }
    //ajax验证
    public function checkOnly(){
        $title = request()->title;
        $where = [];
        if($title){
            $where[] = ['title','=',$title];
        }
        //排除自身
        $id=request()->id;
        if($id){
            $where[] = ['id','!=',$id];
        }
        $count = Wenzhangs::where(['title'=>$title])->count();
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Wenzhangs::find($id);
        // dd($data);
        return view('wenzhang.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //第一种验证
        $request->validate([
                'title'=>['required','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{2,12}+$/u
                ',Rule::unique('wenzhang')->ignore($id),],
                'fenlei'=>['required'],
                'zyx'=>['required'],
                'is_xs'=>['required'],
                
            ],[
                'title.required'=>'标题不能为空',
                'title.regex'=>'标题必须是中文，字母，下划线，数字组成',
                'title.unique'=>'标题已存在',
                'fenlei.required'=>'分类不能为空',
                'zyx.required'=>'重要性不能为空',
                'is_xs.required'=>'显示不能为空',
            ]);
        $data = $request->except('_token');
        //文件修改
        if($request->hasFile('img')){
            $data['img'] = $this->upload('img');
            // dd($img); 
        }
        $res = Wenzhangs::where('id',$id)->update($data);
        if($res!==false){
            return redirect('/WZ/list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Wenzhangs::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
            // return redirect('/WZ/list');
        }
    }
}
