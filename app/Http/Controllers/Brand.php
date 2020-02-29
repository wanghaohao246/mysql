<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brands;
use App\Type;
use App\Pinpai;
class Brand extends Controller
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
        $huohao=request()->huohao??'';
        $where = [];
        if($name){
            $where[] =['name','like',"%$name%"];
        }
         if($huohao){
            $where[] =['huohao','like',"%$huohao%"];
        }
        //分页
        $pageSize = config('app.pageSize');
        $data=Brands::leftjoin('type','brand.t_id','=','type.t_id')
        ->leftjoin('pinpai','brand.b_id','=','pinpai.b_id')
        ->where($where)
        ->orderby('id','desc')
        ->paginate($pageSize);
       return view('brand.index',['data'=>$data,'name'=>$name,'huohao'=>$huohao]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $res=Type::all();

        $data=Pinpai::all();
        $res=CreateTree($res);
// dd($res);
        return view('brand.brand',['res'=>$res,'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        // dd($data);
        //商品货号
        $data['huohao'] = $this->CreateGoodsSn();
        
        //文件上传
        if($request->hasFile('img')){
            $data['img'] =upload('img');
            // dd($img); 
        }
        //多文件上传
        if(isset($data['imgs'])){
            $photos = Moreupload('imgs');
            $data['imgs'] = implode('|',$photos);
        }
        // dd($data);
        //ORM操作
        $Brands=new Brands;
        $res=$Brands->create($data);
        if($res){
            return redirect('/index');
        }
    }
    public function CreateGoodsSn(){
        return 'shop'.date('YmdHis').rand(1000,9999);
    }
    // //上传文件
    // public function upload($filename){
    //     //判断上传过程中有无错误
    //     if(request()->file($filename)->isValid()){
    //         //接收值
    //         $photo = request()->file($filename);
    //         //上传
    //         $store_result = $photo->store('uploads');
    //         return $store_result;
    //     }
    //     exit('未获取上传文件或上传文件过程出错');
    // }

    //ajax验证
    public function checkOnly(){
        $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['name','=',$name];
        }
        //排除自身
        $id=request()->id;
        if($id){
            $where[] = ['id','!=',$id];
        }
        $count = Wenzhangs::where(['name'=>$name])->count();
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
         $res=Type::all();
         $re=Pinpai::all();

        $res=CreateTree($res);
        $data = Brands::find($id);
        // dd($data);
        return view('brand.edit',['data'=>$data,'res'=>$res,'re'=>$re]);
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
        $data = $request->except('_token');
        // dd($data);
        //文件上传
        if($request->hasFile('img')){
            $data['img'] =upload('img');
            // dd($img); 
        }
        //多文件上传
        if(isset($data['imgs'])){
            $photos = Moreupload('imgs');
            $data['imgs'] = implode('|',$photos);
        }
        $res = Brands::where('id',$id)->update($data);
        if($res!==false){
            return redirect('/index');
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
        $res = Brands::destroy($id);
        if($res){
            return redirect('/index');
        }
    }
}
