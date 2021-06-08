<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDoor extends FormRequest
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
     * Get custom attributes for validator chi name.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '門戶名稱',
            'URL' => '自訂連結',
            'image' => '圖片',
            'pic_name' => '圖片說明',
            'title' => '標題',
            'content' => '內文',
            'to_link' => '抵達連結',
            'note' => '備註',
        ];
    }

    /**
     * Get custom messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute 必填',
            'URL' => ':attribute 已被註冊',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required| string',
            'URL' => 'required| string| unique:doors',
            'image' => 'required| image',
            'pic_name' => 'required| string',
            'title' => 'required| string',
            'content' => 'required| string',
            'to_link' => 'required| active_url',
            'note' => '',
        ];
    }
}
