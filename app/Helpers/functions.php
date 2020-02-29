<?php
 function CreateTree($data,$p_id=0,$level=0){
        if(!$data){
            return;
        }
        static $newarray = [];
        foreach($data as $k =>$v){
            if($v->p_id == $p_id){
                $v->level = $level;
                $newarray[]=$v;

                //调用自身
                CreateTree($data,$v->t_id,$level+1);
            }
        }
        return $newarray;
    }
 //单个上传文件
    function upload($filename){
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

    //多个上传文件
    function Moreupload($filename){
        $photo = request()->file($filename);
        if(!is_array($photo)){
            return;
        }
        foreach($photo as $v){
            if($v->isValid()){
                $store_result[] = $v->store('uploads');
            }
        }
            return $store_result;
        // exit('未获取上传文件或上传文件过程出错');
    }
