<?php

namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;

class Stu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       //搜索
        $name=request()->name??'';
        $class=request()->class??'';
        $where = [];
        if($name){
            $where[] =['name','like',"%$name%"];
        }
         if($class){
            $where[] =['class','like',"%$class%"];
        }
        //接受当前页码
        $page = request()->page??1;
        //获取缓存值
        //$data = Cache::get('data');
        $data = cache('goods_'.$page.'_'.$name);
        
        dump($data);
        if(!$data){
            // echo "走DB";
        //分页
        $pageSize = config('app.pageSize');
        $data=Student::where($where)->orderby('id','desc')->paginate($pageSize);
        //存入缓存
        cache(['goods_'.$page.'_'.$name=>$data],20);
        // Cache::flush();
       }
       //获取所有搜索条件
       $query = request()->all();
       //是ajax请求  即要实现的ajax分页
       if(request()->ajax()){
        return view('new.ajaxPage',['data'=>$data,'name'=>$name,'query'=>$query]);
       }
       return view('stu.index',['data'=>$data,'name'=>$name,'class'=>$class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stu.stu');
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
                'name'=>['required','unique:student','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u'],
                'sex'=>'numeric',
                'cj'=>'required|numeric|between:1,100',
            ],[
                'name.required'=>'名字不能为空',
                'name.regex'=>'必须是中文，字母，下划线，数字组成且2-12位',
                'name.unique'=>'名字已存在',
                'sex.numeric'=>'性别必须为数字类型',
                'cj.required'=>'成绩不能为空',
                'cj.numeric'=>'成绩必须为数字',
                'cj.between'=>'成绩不得超过100分',
            ]);
         $data = $request->except('_token');
         // dd($data);
         //文件上传
        if($request->hasFile('img')){
            $data['img'] = upload('img');
            // dd($img); 
        }
         $res = DB::table('student')->insert($data);
         if($res){
            return redirect('/list');
        }
         
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
         // echo $id;
        $data = DB::table('student')->where('id',$id)->first();
        // dd($data);
        return view('stu.edit',['data'=>$data]);
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
                'name'=>['required','regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9]{2,12}$/u',
                        Rule::unique('student')->ignore($id),//,'p_id'
                ],
                'sex'=>'numeric',
                'cj'=>'required|numeric|between:1,100',
            ],[
                'name.unique'=>'名字已存在',
                'name.required'=>'名字不能为空',
                'name.regex'=>'必须是中文，字母，下划线，数字组成且2-12位',
                'sex.numeric'=>'性别必须为数字类型',
                'cj.required'=>'成绩不能为空',
                'cj.numeric'=>'成绩必须为数字',
                'cj.between'=>'成绩不得超过100分',
            ]);
        // echo $id;
        $data = $request->except('_token');
        // dd($data);
         //文件修改
        if($request->hasFile('img')){
            $data['img'] = $this->upload('img');
            // dd($img); 
        }
        $res = DB::table('student')->where('id',$id)->update($data);
        if($res!==false){
            return redirect('/list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del($id)
    {
        $res = DB::table('student')->where('id',$id)->delete();
        if($res){
            return redirect('/list');
        }
    }
}
