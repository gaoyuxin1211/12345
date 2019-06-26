<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
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
    public function rules()
    {
        return [
            'brand_name' => 'required|unique:posts|max:255',
            'brand_desc' => 'required',
        ];
    }
    //laravelacademy.org 
    /* 获取被定义验证规则的错误消息 
       @return array* 
       @translator laravelacademy.org
    */
    public function messages()
    {
     return [
        'brand_name.required' => '不能空', 
        'brand_desc.required' => '描述不空', 
             ];
    }
}
