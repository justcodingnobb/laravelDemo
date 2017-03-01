<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WxconfigRequest extends Request
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
            'data.appid' => 'required',
            'data.appsecret'  => 'required',
            'data.rzurl'  => 'required|url',
            'data.token' => 'required|alpha_dash'
        ];
    }
}
