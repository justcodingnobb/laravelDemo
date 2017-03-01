<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\WxmsgRequest;
use App\Models\Wxlinkage;
use App\Models\Wxmsg;
use Cache;
use Illuminate\Http\Request;

class WxmsgController extends Controller
{
    public function __construct()
    {
    	$this->wxmsg = new Wxmsg;
        $this->wxlinkage = new Wxlinkage;
    }
    public function getIndex(Request $res)
    {
    	$title = '自定义回复';
    	$list = $this->wxmsg->orderBy('id','desc')->paginate(10);
        $type = Cache::get('wxlinkage');
        // 保存一次性数据，url参数，供编辑完成后跳转用
        $res->flash();
    	return view('admin.wxmsg.index',compact('title','list','type'));
    }
    public function getAdd()
    {
        $title = '添加回复';
        // 回复类型
        $typelist = $this->wxlinkage->where('parentid',2)->get();
        return view('admin.wxmsg.add',compact('title','typelist'));
    }
    public function postAdd(WxmsgRequest $res)
    {
        $this->wxmsg->create($res->input('data'));
        return redirect('/admin/wxmsg/index')->with('message','添加回复成功！');
    }
    public function getEdit($id = '')
    {
        $title = '修改回复内容';
        // 拼接返回用的url参数
        $ref = '?page='.old('page');
        $info = $this->wxmsg->findOrFail($id);
        // 回复类型
        $typelist = $this->wxlinkage->where('parentid',2)->get();
        return view('admin.wxmsg.edit',compact('title','info','ref','typelist'));
    }
    public function postEdit(WxmsgRequest $res,$id = '')
    {
        $this->wxmsg->where('id',$id)->update($res->input('data'));
        return redirect('/admin/wxmsg/index'.$res->input('ref'))->with('message','修改回复成功！');
    }
    public function getDel($id = '')
    {
        $this->wxmsg->destroy($id);
        return back()->with('message','删除成功！');
    }
}
