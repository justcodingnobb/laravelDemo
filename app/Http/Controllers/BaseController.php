<?php

namespace App\Http\Controllers;

use App\Models\Cate;
use App\Models\GroupCate;
use App\Http\Requests;
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;

class BaseController extends Controller
{
	// 当前登陆的用户的ID
	public $id = '';
	// 当前登陆的用户所在我租户
	public $saas_id = '';
    // token
    public $token = '';
	public function __construct()
	{
        // 主页里关闭调试
        \Debugbar::disable();
		// $this->middleware('jwt',['only'=>'uploadimg']);
		$this->token = JWTAuth::getToken();
		// 有token的时候取得id,及所在表
		if($this->token)
		{
			$this->id = JWTAuth::getPayload($this->token)->get('sub');
        	$this->saas_id = JWTAuth::getPayload($this->token)->get('saas_id');
		}
	}
    public function resJson($code = 0,$msg = '',$data = [])
    {
    	return ['error_code'=>$code,'message'=>$msg,'data'=>$data];
    }
    // 添加栏目名称
    public function addCatename($data)
    {
    	// 找出所有栏目ID及名称对应
    	$cate = Cate::select('id','name')->get()->keyBy('id')->toArray();
        if (is_array($cate)) {
        	foreach ($data as $k => $v) {
        		$data[$k]['catename'] = $cate[$v['catid']]['name'];
        	}
        }
    	return $data;
    }
    /**
     * 时间转换
     * @param  [type] $data   [数组]
     * @param  [type] $column [列名]
     * @return [type]         [description]
     */
    public function dateStr($data,$column)
    {
        foreach ($data as $k => $v) {
            $data[$k][$column] = Carbon::parse($v[$column])->format('Y/m/d');
        }
        return $data;
    }
}
