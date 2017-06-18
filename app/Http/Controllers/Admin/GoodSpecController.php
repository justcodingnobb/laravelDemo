<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\GoodAttrRequest;
use App\Http\Requests\GoodSpecRequest;
use App\Models\GoodAttr;
use App\Models\GoodCate;
use App\Models\GoodSpec;
use App\Models\GoodSpecItem;
use DB;
use Illuminate\Http\Request;

class GoodSpecController extends BaseController
{
    public function getIndex(Request $res)
    {
    	$title = '商品规格列表';
        $list = GoodSpec::with(['goodcate'=>function($q){
                    $q->select('id','name');
                },'goodspecitem'])->orderBy('id','desc')->paginate(15);
        return view('admin.goodspec.index',compact('list','title'));
    }

    // 添加商品规格
    public function getAdd()
    {
        $title = '添加商品规格';
        // 商品分类
        $all = GoodCate::where('status',1)->orderBy('sort','asc')->get();
        $tree = app('com')->toTree($all,'0');
        $treeHtml = app('com')->toTreeSelect($tree,0);
        return view('admin.goodspec.add',compact('title','treeHtml'));
    }

    public function postAdd(GoodSpecRequest $req)
    {
        $data = $req->input('data');
        $items = app('com')->trim_value($req->input('items'));
        // 插入
        DB::transaction(function () use($data,$items){
        	$goodspec = GoodSpec::create($data);
        	$items = json_decode($items);
        	$goodspecitem = [];
        	$date = date('Y-m-d H:i:s');
        	foreach ($items as $v) {
        		$goodspecitem[] = ['good_spec_id'=>$goodspec->id,'item'=>$v,'created_at'=>$date,'updated_at'=>$date];
        	}
        	GoodSpecItem::insert($goodspecitem);
        });
        return $this->ajaxReturn(1,'添加商品规格成功！',url('/xyshop/goodspec/index'));
    }
    // 修改商品规格
    public function getEdit(Request $req,$id)
    {
        $title = '修改商品规格';
        $info = GoodSpec::with('goodspecitem')->findOrFail($id);
        // 商品分类
        $all = GoodCate::where('status',1)->orderBy('sort','asc')->get();
        $tree = app('com')->toTree($all,'0');
        $treeHtml = app('com')->toTreeSelect($tree,0);
        return view('admin.goodspec.edit',compact('title','info','id','treeHtml'));
    }
    public function postEdit(GoodSpecRequest $req,$id)
    {
        $data = $req->input('data');
        $items = app('com')->trim_value($req->input('items'));
        // 插入
        DB::transaction(function () use($data,$items,$id){
        	GoodSpec::where('id',$id)->update($data);
        	$items = json_decode($items);
        	$goodspecitem = [];
        	$date = date('Y-m-d H:i:s');
        	// 直接删除老的，添加新的
        	GoodSpecItem::where('good_spec_id',$id)->delete();
        	foreach ($items as $v) {
        		$goodspecitem[] = ['good_spec_id'=>$id,'item'=>trim($v),'created_at'=>$date,'updated_at'=>$date];
        	}
        	GoodSpecItem::insert($goodspecitem);
        });
        return $this->ajaxReturn(1,'修改商品规格成功！');
    }
    // 删除商品规格
    public function getDel($id)
    {
    	GoodSpec::destroy($id);
    	// 同时删除相关数据
    	GoodSpecItem::where('good_spec_id',$id)->delete();
        return back()->with('message', '商品规格删除成功！');
    }
}
