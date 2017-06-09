<?php

namespace App\Http\Controllers;

use App\Ecs\Card as c;
use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;

class VueController extends Controller
{
    public function index()
    {
    	/*$url = "https://api.weixin.qq.com/sns/jscode2session?appid=wx1d99bcc1f07ebd6b&secret=e1998edcc82fd9ea370ce1dcb75510da&js_code=013Pxpsa0e8LXs1gLMua01Yxsa0Pxpsi&grant_type=authorization_code";
    	$res = app('com')->postCurl($url,[],'GET');
    	dd($res);*/
/*
// 导卡
    	$data = c::where('user_id',0)->select('vc_type_id','vc_sn','vc_pwd')->get();
    	$tmp = [];
    	$time = date('Y-m-d H:i:s');
    	foreach ($data as $v) {
    		switch ($v->vc_type_id) {
    			case 9:
    				$price = 200;
    				break;
    			case 8:
    				$price = 500;
    				break;
    			case 7:
    				$price = 500;
    				break;
    			case 5:
    				$price = 2000;
    				break;
    			case 3:
    				$price = 1000;
    				break;
    			case 2:
    				$price = 500;
    				break;
    			
    			default:
    				$price = 200;
    				break;
    		}
    		$tmp[] = ['card_id'=>$v->vc_sn,'card_pwd'=>$v->vc_pwd,'price'=>$price,'created_at'=>$time,'updated_at'=>$time];
    	}
    	dd(Card::insert($tmp));*/
    	return view('vue.vue');
    }
}
