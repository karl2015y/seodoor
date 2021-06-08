<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateVendor extends FormRequest
{

    // TODO
    protected $redirectRoute = "create-vendor";

    /**
     * Get custom messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute 必填',
        ];
    }


    /**
     * Get custom attributes for validator chi name.
     *
     * @return array
     */
    public function attributes()
    {
        return [

            'name' => '廠商名稱',
            'phone' => '廠商電話',
            'address' => '廠商地址',
            'person_name' => '聯絡人姓名',
            'person_phone' => '聯絡人電話',
            'note' => '備註',

        ];
    }

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

            'name' => 'required| string',
            'phone' => '',
            'address' => '',
            'person_name' => '',
            'person_phone' => '',
            'note' => '',
            'plan_type_id' => 'required'
        ];
    }
}
