<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wx\WxApi;
use App\Http\Requests;
use App\Http\Requests\WxmenuRequest;
use App\Models\Wxlinkage;
use App\Models\Wxmenu;
use Cache;
use Illuminate\Http\Request;

class WxmenuController extends Controller
{
    public function __construct()
    {
    	$this->wxmenu = new Wxmenu;
    	$this->wxlinkage = new Wxlinkage;
    }
    public function getIndex($pid = 0)
    {
    	$title = '自定义菜单';
    	$all = $this->wxmenu->where('parentid',$pid)->get();
    	$linkname = Cache::get('wxlinkage');
    	return view('admin.wxmenu.index',compact('title','all','pid','linkname'));
    }
    public function getAdd($pid = 0)
    {
    	$title = '添加自定义菜单';
    	// 取类型名
    	$type = $this->wxlinkage->where('parentid',1)->get();
    	return view('admin.wxmenu.add',compact('title','pid','type'));
    }
    public function postAdd(WxmenuRequest $res,$pid = 0)
    {
    	$this->wxmenu->create($res->input('data'));
    	return redirect('/admin/wxmenu/index/'.$pid)->with('message','添加菜单成功！');
    }
    public function getEdit($id = 0)
    {
    	$title = '修改自定义菜单';
    	$info = $this->wxmenu->findOrFail($id);
    	// 取类型名
    	$type = $this->wxlinkage->where('parentid',1)->get();
    	return view('admin.wxmenu.edit',compact('title','pid','type','info'));
    }
    public function postEdit(WxmenuRequest $res,$id = 0)
    {
    	$this->wxmenu->where('id',$id)->update($res->input('data'));
    	return redirect('/admin/wxmenu/index')->with('message','修改菜单成功！');
    }
    public function getDel($id = 0)
    {
    	$havChild = $this->wxmenu->where('parentid',$id)->get();
    	$this->wxmenu->destroy($id);
    	// 如果有子菜单,循环删除子菜单
    	if ($havChild->count() > 0) {
	    	foreach ($havChild as $v) {
	    		$this->getDel($v->id);
	    	}
	    }
    	return back()->with('message','删除成功！');
    }
    // 更新服务器菜单
    public function getUpdate()
    {
        $wxapi = new WxApi();
        // 取得access_token
        $atoken = $wxapi->token();
        $delurl = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$atoken;
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$atoken;
        $menuarr = Wxmenu::where('parentid',0)->select("id","name","key","type","url")->get()->toArray();
        foreach ($menuarr as $k => $v) {
            $subres = Wxmenu::where('parentid',$v['id'])->select("id","name","key","type","url")->get();
            if ($subres->count() > 0) {
                $menuarr[$k]['sub_button'] = $subres->toArray();
            }
            unset($menuarr[$k]['id']);
        }
        $data = '{"button":'.json_encode($menuarr,JSON_UNESCAPED_UNICODE).'}';
        // 向微信发送消息
        $del = $wxapi->httpGet($delurl);
        $del = json_decode($del,true);
        // 向微信发送消息
        $result = $wxapi->httpGet($url,$data);
        $result = json_decode($result,true);
        if ($del['errmsg'] == 'ok' && $result['errmsg'] == 'ok') {
	        return back()->with('message','刷新菜单成功，24小时后显示正常！');
        }else{
            return back()->with('message',"更新失败！".$del['errcode']."-".$result['errcode']);
        }
        
    }
}
