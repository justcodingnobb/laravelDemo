<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ArtRequest extends Request
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
            'data.title' => 'required|max:255',
            'data.catid' => 'required|integer|not_in:0',
            'data.content' => 'required',
            'data.listorder'  => 'required|integer',
            'data.url' => 'url',
        ];
    }
    public function attributes()
    {
        return [
            'data.catid' => '栏目ID',
            'data.title' => '标题',
            'data.content' => '内容',
            'data.url' => 'URL',
            'data.listorder' => '排序',
        ];
    }
}
