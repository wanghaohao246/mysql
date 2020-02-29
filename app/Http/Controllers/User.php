<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\People;
use Validator;
use App\Http\Requests\StorePeoplePost;;
class User extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $data = DB::table('user')->select('*')->get();
       // $data = People::all();
        //搜索
        $p_name=request()->p_name??'';
        $where = [];
        if($p_name){
            $where[] =['p_name','like',"%$p_name%"];
        }
        //分页
        $pageSize = config('app.pageSize');
        $data=People::where($where)->orderby('p_id','desc')->paginate($pageSize);
       return view('user.index',['data'=>$data,'p_name'=>$p_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)//StorePeoplePost第二种
    {
        //第一种验证
        // $request->validate([
        //         'p_name'=>'required|unique:user|max:12|min:2',
        //         'age'=>'required|integer|min:1|max:3',
        //     ],[
        //         'p_name.required'=>'名字不能为空',
        //         'p_name.unique'=>'名字已存在',
        //         'p_name.max'=>'名字长度不超过12位',
        //         'p_name.min'=>'名字长度不少于2位',
        //         'age.required'=>'年龄不能为空',
        //         'age.integer'=>'年龄必须维数字',
        //         'age.min'=>'年龄数据不合法',
        //         // 'age.required'=>'年龄数据不合法',
        //     ]);


        $data = $request->except('_token');
        // dd($data);
        // 验证
        $validator=validator::make($data,[

            'p_name'=>'required|unique:user|max:12|min:2',
            'age'=>'required|integer|between:1,130',
        ],[

            'p_name.required'=>'名字不能为空',
            'p_name.unique'=>'名字已存在',
            'p_name.max'=>'名字长度不能超过12位',
            'p_name.min'=>'名称长度不能少于2位',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须为数字',
            'age.min'=>'年龄数据不合法',
            'age.required'=>'年龄数据不合法',
        ]);
        if($validator->fails()){
            return redirect ('/create')
                    ->withErrors($validator)
                    ->withInput();
        }
        //文件上传
        if($request->hasFile('img')){
            $data['img'] = $this->upload('img');
            // dd($img); 
        }
        $data['add_time'] = time();
        // $res = DB::table('user')->insert($data);
        //ORM操作
        $People=new People;
        $res=$People->create($data);
        if($res){
        	return redirect('/user');
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
        // $data = DB::table('user')->where('p_id',$id)->first();
        $data = People::find($id);
        // dd($data);
        return view('user.edit',['data'=>$data]);
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
        // echo $id;
        $data = $request->except('_token');
        // dd($data);
        // $res = DB::table('user')->where('p_id',$id)->update($data);
        $res = People::where('p_id',$id)->update($data);
        if($res!==false){
        	return redirect('/user');
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
        // $res = DB::table('user')->where('p_id',$id)->delete();
        $res = People::destroy($id);
        if($res){
        	return redirect('/user');
        }
    }
}
