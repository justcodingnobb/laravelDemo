<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\WxconfigRequest;
use App\Models\Wxconfig;
use Illuminate\Http\Request;
use Cache;

class WxController extends Controller
{
    public function __construct()
    {
    	$this->wxconfig = new Wxconfig;
    }
    public function getConfig()
    {
    	$title = '微信配置';
    	$info = $this->wxconfig->findOrFail(1);
    	return view('admin.wx.config',compact('title','info'));
    }
    public function postConfig(WxconfigRequest $res)
    {
    	$data = $res->input('data');
    	$this->wxconfig->where('id',1)->update($data);
    	// 更新缓存
    	Cache::forget('wxconf');
    	Cache::forever('wxconf',$data);
    	return back()->with('message','修改微信配置成功！');
    }
    // 清空缓存
    public function getEmptycache()
    {
        Cache::forget('wxconf');
        return back()->with('message','清空缓存成功！');
    }
    // 清空数据
    public function getEmptydata()
    {
        // M('Wxuser')->where("userid > 0")->delete();
        return back()->with('message','清空数据成功！');
    }
}
