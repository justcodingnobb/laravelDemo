<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodAttrRequest extends FormRequest
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
            'data.name' => 'required|max:100',
            'data.parentid'  => 'integer',
            'data.value'  => 'max:100',
            'data.unit'  => 'max:100',
        ];
    }
    
    public function attributes()
    {
        return [
            'data.name' => '名称',
            'data.parentid'  => '父ID',
            'data.value'  => '值',
            'data.unit'  => '单位',
        ];
    }
}
