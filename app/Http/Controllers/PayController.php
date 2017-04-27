<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Models\Pay;
use DB;
use Illuminate\Http\Request;
use Omnipay\Omnipay;

class PayController extends BaseController
{
    // 取订单可以使用的支付方式
    public function list($oid)
    {
    	$seo = ['title'=>'选择支付方式','keyword'=>config('shop.keyword'),'description'=>config('shop.description')];
    	$goodcateid = 0;
        $pcatid = '100';
    	$order = Order::findOrFail($oid);
    	$paylist = Pay::where('status',1)->where('paystatus',1)->orderBy('id','asc')->get();
    	return view(config('shop.pc').'paylist',compact('seo','goodcateid','pcatid','order','paylist'));
    }
    // 真正的支付
    public function pay(Request $req,$oid)
    {
    	if ($req->pay == '') {
    		return back()->with('message','请选择支付方式');
    	}
    	$pay = Pay::findOrFail($req->pay);
    	// 根据支付方式调用不同的SDK
    	$pmod = $pay->code;
    	$ip = $req->ip();
    	$this->$pmod($oid,$pay,$ip);
    }

    // 支付宝支付
    private function alipay($oid,$pay,$ip = '')
    {
    	$set = json_decode($pay->setting);
    	// 手机网站支付NEW
    	/*$gateway = Omnipay::create('Alipay_AopWap');
    	$gateway->setAppId($set->alipay_appid);
		$gateway->setPrivateKey($set->alipay_privatekey);
		$gateway->setAlipayPublicKey($set->alipay_publickey);*/
    	// 即时到账
    	$gateway = Omnipay::create('Alipay_LegacyExpress');
		$gateway->setSellerEmail($set->alipay_account);
		$gateway->setPartner($set->alipay_partner);
		$gateway->setKey($set->alipay_key); 
		//For MD5 sign type
		//$gateway->setPrivateKey('the_rsa_sign_key'); //For RSA sign type
		//$gateway->setAlipayPublicKey('the_alipay_public_key'); //For RSA sign type
		$gateway->setReturnUrl(config('app.url').'/alipay/return');
		$gateway->setNotifyUrl(config('app.url').'/alipay/gateway');

		$request = $gateway->purchase([
		  'out_trade_no' => date('YmdHis').mt_rand(1000,9999),
		  'subject'      => 'test',
		  'total_fee'    => '0.01',
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
				<body></body>
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
