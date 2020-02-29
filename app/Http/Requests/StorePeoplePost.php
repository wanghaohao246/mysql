<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeoplePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    // public function rules()
    // {
    //     return [
    //         'p_name'=>'required|unique:user|max:12|min:2',
    //         'age'=>'required|integer|min:1|max:3',
    //     ];
    // }
    // public function messages(){
    //     return [
    //         'p_name.required'=>'名字不能为空',
    //         'p_name.unique'=>'名字已存在',
    //         'p_name.max'=>'名字长度不超过12位',
    //         'p_name.min'=>'名字长度不少于2位',
    //         'age.required'=>'年龄不能为空',
    //         'age.integer'=>'年龄必须维数字',
    //         'age.min'=>'年龄数据不合法',
    //     ];
    // }
}
