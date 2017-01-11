<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Validator;

class UserController extends BaseController
{
	// 登陆
    public function postLogin(Request $res)
    {
    	$validator = Validator::make($res->input(), [
	        'username' => 'required',
	        'password' => 'required',
	    ]);
	    if ($validator->fails()) {
	        // 如果有错误，提示第一条
	        $result = $this->resJson(0,$validator->errors()->all()[0],'');
	        return $result;
	    }
	    $username = $res->input('username');
	    $password = $res->input('password');
	    $user = User::where('status',1)->where('username',$username)->first();
	    if (is_null($user)) {
	    	$result = $this->resJson(102,'APP中没有此用户！','');
	    	return $result;
	    } 
		// 使token失效
		if (!is_null($user->token) && strlen($user->token) == 297) {
			try{
				JWTAuth::setToken($user->token)->invalidate();
			} catch (TokenExpiredException $e) {
			} catch (JWTException $e) {
			}
		}
	    // 登陆验证使用数据库查询，不用Auth
	    if (!is_null($user))
	    {
	    	// 添加登陆日志记录
	    	$log['userid'] = $user->id;
	    	$log['username'] = $user->username;
	    	$log['data'] = 'api/login';
	    	$log['ip'] = $res->ip();
	    	UserLog::create($log);
	    	// Token中添加参数
	        $data['id'] = $user->id;
	        $data['username'] = $user->username;
	        $data['realname'] = $user->realname;
	        $data['token'] = JWTAuth::fromUser($user,$customClaims);
			// 保存token到数据库
			User::where('id',$user->id)->update(['token'=>$data['token']]);
	    }
	    else
	    {
	        $result = $this->resJson(0,'登陆失败！','');
	    }
	    // all good so return the token
	    return $result;
    }
    // 退出登陆
    public function postLogout(Request $res)
    {
    	$validator = Validator::make($res->all(), [
	        'token' => 'required'
	    ]);
	    if ($validator->fails()) {
	        // 如果有错误，提示第一条
	        $result = $this->resJson(0,$validator->errors()->all()[0],'');
	        return $result;
	    }
    	$token = JWTAuth::getToken();
		if ($token) {
		    JWTAuth::setToken($token)->invalidate();
		}
		$result = $this->resJson(1,'成功退出！','');
		return $result;
    }
}
