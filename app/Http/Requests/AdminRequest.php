<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminRequest extends Request
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
            'data.role_id' => 'sometimes|required',
            'data.name' => 'sometimes|required|min:5|unique:admins,name,'.$this->segment('4'),
            'data.email' => 'sometimes|required|email|unique:admins,email,'.$this->segment('4'),
            'data.password' => 'sometimes|required|confirmed|min:6|max:15|alpha_dash',
            'data.phone' => 'sometimes|integer|min:7',
            'data.realname' => 'sometimes|min:2|alpha_num',

            'datas.email' => 'sometimes|required|email|unique:admins,email,'.session('user')->id,
            'datas.phone' => 'sometimes|integer|min:7',
            'datas.realname' => 'sometimes|min:2|alpha_num',
        ];
    }
    
    public function attributes()
    {
        return [
            'data.role_id' => '角色',
            'data.name' => '用户名',
            'data.email' => '邮箱',
            'data.password' => '密码',
            'data.phone' => '手机号',
            'data.realname' => '真实姓名',
        ];
    }
}
