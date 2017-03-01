<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WxmenuRequest extends Request
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
            'data.name' => 'required|min:2',
            'data.type'  => 'required|alpha',
            'data.parentid'  => 'required|integer',
            'data.url'  => 'sometimes|url',
            'data.listorder'  => 'required|integer',
        ];
    }
}
