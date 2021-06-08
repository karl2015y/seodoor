<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreatePlanType extends FormRequest
{


    protected $redirectRoute = "create-plan-type";

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute 必填',
            'numeric' => ':attribute 必須為數字',
        ];
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '方案名稱',
            'days' => '授權天數',
            'door_counts' => '門戶數量',
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
            'days' => 'required| numeric',
            'door_counts' => 'required| numeric',

        ];
    }
}
