<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\WxlinkageRequest;
use App\Models\Wxlinkage;
use Illuminate\Http\Request;
use Cache;

class WxlinkageController extends Controller
{
    public function __construct()
    {
    	$this->wxlinkage = new Wxlinkage;
    }
    public function getIndex($pid = 0)
    {
    	$title = '关联菜单';
    	$all = $this->wxlinkage->where('parentid',$pid)->get();
    	return view('admin.wxlinkage.index',compact('title','all','pid'));
    }
    /**
     * 添加关联
     * @param  integer $pid [父ID]
     * @return [type]       [description]
     */
    public function getAdd($pid = 0)
    {
    	$title = '添加关联';
    	return view('admin.wxlinkage.add',compact('title','pid'));
    }
    public function postAdd(WxlinkageRequest $res)
    {
        $data = $res->input('data');
    	$this->wxlinkage->create($data);
        // 更新缓存
        $this->updateCache();
    	return redirect('/admin/wxlinkage/index/'.$res->input('data.parentid'))->with('message','添加关联成功');
    }
    /**
     * 修改关联
     * @param  integer $id [id]
     * @return [type]      [description]
     */
    public function getEdit($id = 0)
    {
    	$title = '修改关联';
    	$info = $this->wxlinkage->findOrFail($id);
    	return view('admin.wxlinkage.edit',compact('title','info'));
    }
    public function postEdit(WxlinkageRequest $res,$id = '')
    {
    	$this->wxlinkage->where('id',$id)->update($res->input('data'));
        // 更新缓存
        $this->updateCache();
        return redirect('/admin/wxlinkage/index/'.$res->input('data.parentid'))->with('message','修改关联成功');
    }
    // 删除功能
    public function getDel($id = '')
    {
    	$havChild = $this->wxlinkage->where('parentid',$id)->get();
    	$this->wxlinkage->destroy($id);
    	// 如果有子菜单,循环删除子菜单
    	if ($havChild->count() > 0) {
	    	foreach ($havChild as $v) {
	    		$this->getDel($v->id);
	    	}
	    }
        // 更新缓存
        $this->updateCache();
    	return back()->with('message','删除成功！');
    }
    // 更新关联缓存
    private function updateCache()
    {
        Cache::forget('wxlinkage');
        $all = $this->wxlinkage->get()->toArray();
        $temp =  [];
        foreach ($all as $k) {
            $temp[$k['val']] = $k['name'];
        }
        Cache::forever('wxlinkage',$temp);
    }
}
