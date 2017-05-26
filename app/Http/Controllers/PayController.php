<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Good;
use App\Models\GoodFormat;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Pay;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use QrCode;
use Storage;

class PayController extends BaseController
{
    // 取订单可以使用的支付方式
    public function list($oid)
    {
    	$info = (object) ['pid'=>0];
    	$order = Order::findOrFail($oid);
    	$paylist = Pay::where('status',1)->where('paystatus',1)->orderBy('id','asc')->get();
    	return view($this->theme.'.paylist',compact('info','order','paylist'));
    }
    // 真正的支付
    public function pay(Request $req,$oid)
    {
    	if ($req->pay == '') {
    		return back()->with('message','请选择支付方式');
    	}
    	$pay = Pay::findOrFail($req->pay);
    	// 是否支付过
    	$paystatus = Order::where('id',$oid)->value('paystatus');
    	if ($paystatus) {
    		return back()->with('message','支付过了！');
    	}
    	// 根据支付方式调用不同的SDK
    	$pmod = $pay->code;
    	$ip = $req->ip();
    	$res = $this->$pmod($oid,$pay,$ip);
    	if ($res) {
    		return redirect('user/order')->with('message','支付成功！');
    	}
    	else
    	{
    		return back()->with('message','支付失败，稍后再试！');
    	}
    }

    // 余额支付
    private function yue($oid,$pay,$ip = '')
    {
    	// 查可用余额是否够用
    	$order = Order::findOrFail($oid);
    	$user_money = User::where('id',$order->user_id)->value('user_money');
    	if ($user_money < $order->total_prices) {
    		return back()->with('message','余额不足，请选择其它支付方式！');
    	}
		// 库存计算
		$this->updateStore($order);
    	return true;
    }

    // 支付宝支付
    private function alipay($oid,$pay,$ip = '')
    {
    	$set = json_decode($pay->setting);
    	// 手机网站支付NEW
    	$gateway = Omnipay::create('Alipay_AopWap');
    	$gateway->setSignType('RSA'); //RSA/RSA2
    	$gateway->setAppId($set->alipay_appid);
		$gateway->setPrivateKey('-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDswrmWnApQ6MKBY6ozxMTf6kfgSsSuqI90eqOhydbkkl9uaBqR
PwkqWkPRxLgz4uh5qNMNbzDLkEFbLaWKpCECUU+VwyovoOeE4T4bHRQR+cXq2h8Q
tbq6kOXrUFff0ZfzA5JTEU9amxU48b74Z+PQN5l2dAiE9Spi4+vYfA6AIQIDAQAB
AoGBANS9hBWY0IwzGdM5ws4RmPW6his8A88NFxoKuM2/l6B7BdUnJfgtNAciZJ4w
rXOyCEKJOFtx9d50GMXdFkqlgCHijVwMNan54wogdK4f4wghjpQlrytyzYhW/CKy
Ggr4sZmYqJJY+8GR9SS5qGflcfER+4De864EoIIHurH61UABAkEA9yqDjo8+rAsq
nCNCvNZnhov4IBXQ4T/LIxH5fXqvGD3fyIs5BAbjGYlIprewv8l2SxQJ1Oj9KbJC
ctyh4ldSwQJBAPU5AUMH1rN9xiunE2iv127HyEd2nvBeKQlM5RFfwlymH9hafG6H
wGAqW42j+3e4CmeUik+rstBPTabgAyPSZWECQC9AeHAboH6hj97TuuGBF7+YKLJx
mUJGwN4OhKThfHHk+lBLlXXYnzf1j+cXfPndWPkXdp22gReklaGB3oz35sECQFR+
/fZQ3yQd9IjaGw/5dywO3u3w67c7Wrx/qHaiHmC6RULRewrC8ACy17Uoid+opL0o
K7hkG0s36DPWAH75YkECQQDk1qo49/chr+9CiA5HmF4ULRqpLrEBp9IhF9FR2zsj
QmJaTs9taAe/xBbQbhsoJXrmSzAWPtDu86wYchHDiWH4
-----END RSA PRIVATE KEY-----');
		$gateway->setAlipayPublicKey('-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDswrmWnApQ6MKBY6ozxMTf6kfg
SsSuqI90eqOhydbkkl9uaBqRPwkqWkPRxLgz4uh5qNMNbzDLkEFbLaWKpCECUU+V
wyovoOeE4T4bHRQR+cXq2h8Qtbq6kOXrUFff0ZfzA5JTEU9amxU48b74Z+PQN5l2
dAiE9Spi4+vYfA6AIQIDAQAB
-----END PUBLIC KEY-----');
    	// 即时到账
    	/*$gateway = Omnipay::create('Alipay_LegacyExpress');
		$gateway->setSellerEmail($set->alipay_account);
		$gateway->setPartner($set->alipay_partner);
		$gateway->setKey($set->alipay_key); */
		//For MD5 sign type
		// $gateway->setPrivateKey('the_rsa_sign_key'); //For RSA sign type
		// $gateway->setAlipayPublicKey('the_alipay_public_key'); //For RSA sign type
		$gateway->setReturnUrl(config('app.url').'/alipay/return');
		$gateway->setNotifyUrl(config('app.url').'/alipay/gateway');

		$request = $gateway->purchase()->setBizContent([
		  'out_trade_no' => date('YmdHis').mt_rand(1000,9999),
		  'subject'      => 'test',
		  'total_amount'    => '0.01',
		  'product_code' => 'QUICK_WAP_PAY',
		]);

		/**
		 * @var LegacyExpressPurchaseResponse $response
		 */
		$response = $request->send();

		// 下单后跳转到支付页面
		// $redirectUrl = $response->getRedirectUrl();
		//or 
		$response->redirect();
    }

    // 微信支付
    private function weixin($oid,$pay,$ip)
    {
    	$set = json_decode($pay->setting);
    	$gateway = Omnipay::create('WechatPay_Native');
		$gateway->setAppId($set->appid);
		$gateway->setMchId($set->mchid);
		$gateway->setApiKey($set->appkey);
		$gateway->setNotifyUrl(config('app.url').'/weixin/gateway');

		$order = [
		    'body'              => 'The test order',
		    'out_trade_no'      => date('YmdHis').mt_rand(1000, 9999),
		    'total_fee'         => 1, //=0.01
		    'spbill_create_ip'  => $ip,
		    'fee_type'          => 'CNY',
		    'openid'			=> 'o55kNw1TVsDdzTj5CPZGF6cVDhu8',
		];
		/**
		 * @var Omnipay\WechatPay\Message\CreateOrderRequest $request
		 * @var Omnipay\WechatPay\Message\CreateOrderResponse $response
		 */
		$request  = $gateway->purchase($order);
		$response = $request->send();
		
		//available methods
		// 如果下单成功，调起支付动作
		if($response->isSuccessful())
		{
			$codeurl = $response->getCodeUrl();
			// 移动到新的位置，先创建目录及更新文件名为时间点
			// 生成文件名
        	$filename = date('Ymdhis').rand(100, 999);
            $dir = public_path('upload/qrcode/'.date('Ymd').'/');
            if(!is_dir($dir)){
                Storage::makeDirectory('qrcode/'.date('Ymd'));
            }
            $path = $dir.$filename.'.png';
            $src = '/upload/qrcode/'.date('Ymd').'/'.$filename.'.png';
			$ewm = QrCode::format('png')->size(200)->generate($codeurl,$path);
			echo "<h3>扫码支付</h3><img src='".$src."'/>";
		}
		else
		{
			return back()->with('message','支付失败，请稍后再试');
		}

		// $response->getData(); //For debug
		// $response->getAppOrderData(); //For WechatPay_App
		// $response->getJsOrderData(); //For WechatPay_Js
		// $response->getCodeUrl(); //For Native Trade Type
    }

    // 微信支付js
    private function weixin_js($oid,$pay,$ip)
    {
    	$set = json_decode($pay->setting);
    	$gateway = Omnipay::create('WechatPay_Js');
		$gateway->setAppId($set->appid);
		$gateway->setMchId($set->mchid);
		$gateway->setApiKey($set->appkey);
		$gateway->setNotifyUrl(config('app.url').'/weixin/gateway');

		$order = [
		    'body'              => 'The test order',
		    'out_trade_no'      => date('YmdHis').mt_rand(1000, 9999),
		    'total_fee'         => 1, //=0.01
		    'spbill_create_ip'  => $ip,
		    'fee_type'          => 'CNY',
		    'openid'			=> 'o55kNw1TVsDdzTj5CPZGF6cVDhu8',
		];
		/**
		 * @var Omnipay\WechatPay\Message\CreateOrderRequest $request
		 * @var Omnipay\WechatPay\Message\CreateOrderResponse $response
		 */
		$request  = $gateway->purchase($order);
		$response = $request->send();

		//available methods
		// 如果下单成功，调起支付动作
		if($response->isSuccessful())
		{
			$d = $response->getJsOrderData();
			$str = "
			<html>
				<head>
					<script>
						function onBridgeReady(){
						    WeixinJSBridge.invoke('getBrandWCPayRequest',{
						           	'appId':'".$set->appid."',
						           	'timeStamp':".$d['timeStamp'].",
						           	'nonceStr':'".$d['nonceStr']."',
						           	'package':'".$d['package']."',     
						           	'signType': '".$d['signType']."',
									'paySign': '".$d['paySign']."',
						       },
						       function(res){
						            if(res.err_msg == 'get_brand_wcpay_request:ok') {
						            	alert('ok');
						            }
						            if(res.err_msg == 'get_brand_wcpay_request:fail')
						            {
						            	alert('fail');
						            }
						        }
						    );
						}
						window.onload = function(){
							if (typeof WeixinJSBridge == 'undefined'){
							   if( document.addEventListener ){
							       document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
							   }else if (document.attachEvent){
							       document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
							       document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
							   }
							}else{
							   onBridgeReady();
							}
						}
					</script>
				</head>
				<body>
				".$set->appid."
				</body>
			</html>";
			echo $str;
		}
		else
		{
			return back()->with('message','支付失败，请稍后再试');
		}

		// $response->getData(); //For debug
		// $response->getAppOrderData(); //For WechatPay_App
		// $response->getJsOrderData(); //For WechatPay_Js
		// $response->getCodeUrl(); //For Native Trade Type
    }
}
