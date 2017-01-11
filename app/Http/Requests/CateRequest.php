<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CateRequest extends Request
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
            'data.name' => 'required|unique:categorys,name,'.$this->segment('4'),
            'data.listorder'  => 'required|integer',
            'data.url' => 'sometimes|url',
        ];
    }
    
    public function attributes()
    {
        return [
            'data.name' => '名称',
            'data.url' => 'URL',
            'data.listorder' => '排序',
        ];
    }
}
