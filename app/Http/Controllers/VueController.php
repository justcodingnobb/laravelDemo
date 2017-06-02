<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VueController extends Controller
{
    public function index()
    {
    	/*$url = "https://api.weixin.qq.com/sns/jscode2session?appid=wx1d99bcc1f07ebd6b&secret=e1998edcc82fd9ea370ce1dcb75510da&js_code=013Pxpsa0e8LXs1gLMua01Yxsa0Pxpsi&grant_type=authorization_code";
    	$res = app('com')->postCurl($url,[],'GET');
    	dd($res);*/
    	return view('vue.vue');
    }
}
