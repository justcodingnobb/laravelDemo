<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WxmsgRequest extends Request
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
            'data.title' => 'required|min:2',
            'data.con' => 'required|min:2',
            'data.type'  => 'required|alpha',
            'data.url'  => 'sometimes|url',
        ];
    }
}
