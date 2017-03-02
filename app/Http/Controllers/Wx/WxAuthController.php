<?php

namespace App\Http\Controllers\Wx;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wx\WxApi;
use App\Http\Requests;
use Cache;
use Illuminate\Http\Request;
use Session;

class WxAuthController extends Controller
{
	private $wxapi;
	public function __construct()
	{
        $this->wxapi = new WxApi();
	}
    // 用户点击的页面地址，从这里（https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1bb03278d5d74909&redirect_uri=http://www.muzisheji.com/wx/index.php/oauth/index.html&response_type=code&scope=snsapi_base&state=1#wechat_redirect）跳转到现在这个页面，然后进行openID的获取，再进行逻辑操作。
	/*
	静默授权：授权完成以后，用Openid该干嘛干嘛
	1、index($hdid)主入口，跳转到微信上取用户的openid。
	*/
	public function getIndex(Request $res){
		$code = $res->get('code') ? $res->get('code') : 0;
		// 根据code判断是否取到了openid，没有先取openid
		if(!Session::has('openid')){
			// 取openid
			$openid = $this->oauthtoken($code);
			if (empty($openid)){
				// 这里的appid一定要换，url也要换
				header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".Cache::get('wxconf')['appid']."&redirect_uri=".config('app.url')."/wx/auth&response_type=code&scope=snsapi_base&state=1#wechat_redirect");
				exit;
			}
		}
		// 分享参数
        // $signPackage = $this->wxapi->share();
        // 分享参数结束
        echo session('openid');
	}

	// 手动授权，授权完成以后，用Openid该干嘛干嘛
	public function getUserinfo(Request $res){
		$code = $res->get('code') ? $res->get('code') : 0;
		// 根据code判断是否取到了openid，没有先取openid
		if(!Session::has('openid')){
			// 取openid
			$openid = $this->oauthtoken($code);
			if (empty($openid)){
				// 这里的appid一定要换，url也要换
				header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".Cache::get('wxconf')['appid']."&redirect_uri=".config('app.url')."/wx/mauth&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");
				exit;
			}
		}
		// 分享参数
        // $signPackage = $this->wxapi->share();
        // 分享参数结束
        echo session('openid').'中文的了';
	}

	// 取得oauth用的access_token
    private function oauthtoken($code){
        $wxconfig = Cache::get('wxconf');
        $appid = $wxconfig['appid'];
        $appsecret = $wxconfig['appsecret'];
        $access_token = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$code."&grant_type=authorization_code");
        $atoken = json_decode($access_token,true);
        // 如果返回的值不对，就要再登陆
        if (isset($atoken['openid'])) {
        	Session::put('openid',$atoken['openid']);
        	return $atoken['openid'];
        }
        else
        {
        	return '';
        }
    }
}
