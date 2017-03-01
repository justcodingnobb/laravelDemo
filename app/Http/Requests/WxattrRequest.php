<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WxattrRequest extends FormRequest
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
            'data.type' => 'required',
            'data.image'  => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'data.type' => '类型',
            'data.image' => '附件',
        ];
    }
}
