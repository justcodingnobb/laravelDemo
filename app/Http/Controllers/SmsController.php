<?php

namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Sms\AlibabaAliqinFcSmsNumSendRequest;
use App\Http\Controllers\Sms\TopClient;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\BaseController;

class SmsController extends BaseController
{
    public function postIndex(Request $res)
    {
    	// 错误日志目录
    	define('TOP_SDK_WORK_DIR',storage_path());
    	
		// 判断手机号是否填写
		if (!isset($res->phone))
		{
			$result = $this->resJson(0,'请填写手机号！','');
	    	return $result;
		}
		// 设置默认短信模板、短信签名
		$smstpl = isset($res->smstpl) ? $res->smstpl : 'SMS_7490067';
		$singName = isset($res->singName) ? $res->singName : '注册验证';
    	$c = new TopClient;
	    $req = new AlibabaAliqinFcSmsNumSendRequest;
	    $req->setExtend("123456");
	    $req->setSmsType("normal");
	    $req->setSmsFreeSignName($singName);
	    // 生成验证码，6位随机字符串
	    $code = App::make('com')->random(6);
	    $req->setSmsParam("{\"code\": \"$code\", \"product\": \"基纳电子医生\"}");
	    //请填写需要接收的手机号码
	    $req->setRecNum($res->phone);
	    //短信模板id
	    $req->setSmsTemplateCode($smstpl);
	    $resp = $c->execute($req);
	    // 如果发送成功(code为错误码，如果没有，说明发送成功)，添加数据库记录，时间标记为半小时之后
	    if (!isset($resp->code))
		{
			$result = $this->resJson(1,'发送成功！',$data);
	    }
		else
		{
			$result = $this->resJson(0,'发送失败！',$resp);
		}
	    return $result;
    }
}
