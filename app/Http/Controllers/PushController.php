<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Push\PushSDK;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;

class PushController extends BaseController
{
	public function __construct()
	{
		// 创建SDK对象.
		$this->push = new PushSDK();
	}
    public function postMsgtosingle(Request $res)
    {

		// 找到对应的channel_id
		$channelId = $res->channel_id;
		
		
		// message content.
		$message = array (
		    // 消息的标题.
		    'title' => $res->title,
		    // 消息内容
		    'description' => $res->description,
		);

		// 设置消息类型为 通知类型.
		$opts = array (
		    'msg_type' => (int) $res->msg_type,
		    'deploy_status' => config('push.deploy_status'),
		);

		// 向目标设备发送一条消息
		$rs = $this->push->pushMsgToSingleDevice($channelId,$message, $opts);
		// 判断返回值,当发送失败时, $rs的结果为false, 可以通过getError来获得错误信息.
		if($rs === false){
		    $result = $this->resJson($this->push->getLastErrorCode(),$this->push->getLastErrorMsg(),'');
		}else{
			$result = $this->resJson(1,'发送成功',$rs);
		}
		return $result;
    }
}
