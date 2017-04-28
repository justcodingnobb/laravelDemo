<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\BaseController;
use App\Http\Requests;
use App\Models\Pay;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use Storage;

class WxpayController extends BaseController
{
    // 通知页面，放一起了
    public function gateway(Request $req)
    {
        $gateway = Omnipay::create('WechatPay');
        $gateway->setAppId($set->appid);
        $gateway->setMchId($set->mchid);
        $gateway->setApiKey($set->appkey);
        $response = $gateway->completePurchase([
            'request_params' => file_get_contents('php://input')
        ])->send();
        // 判断是否成功
        if ($response->isPaid()) {
            //pay success
            // 写入到日日志里方便查看
            Storage::prepend('wxpay.log',json_encode($response->getRequestData()));
            $resData = $response->getRequestData();
            // 更改订单状态为已经支付
            // $this->orderPay($resData['out_trade_no']);
            $msg = ['msg'=>'OK','code'=>'SUCCESS'];
        }else{
            //pay fail
            Storage::prepend('wxpay.log',json_encode($response->getRequestData()));
            $msg = ['msg'=>'error','code'=>'FAIL'];
        }
        $tpl = "<xml>
                    <return_code><![CDATA[".$msg['code']."]]></return_code>
                    <return_msg><![CDATA[".$msg['msg']."]]></return_msg>
                    </xml>
                    ";
        return $tpl;
    }
}
