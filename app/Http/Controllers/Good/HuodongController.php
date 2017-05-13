<?php

namespace App\Http\Controllers\Good;

use App\Http\Controllers\Controller;
use App\Http\Requests\Good\HuodongRequest;
use App\Models\Good;
use App\Models\HdGood;
use App\Models\Huodong;
use DB;
use Illuminate\Http\Request;

class HuodongController extends Controller
{
    /**
     * 活动列表
     * @return [type] [description]
     */
    public function getIndex(Request $res)
    {
    	$title = '活动列表';
        // 搜索关键字
        $key = trim($res->input('q',''));
        $starttime = $res->input('starttime');
        $endtime = $res->input('endtime');
        $status = $res->input('status');
		$list = Huodong::where(function($q) use($key){
                if ($key != '') {
                    $q->where('title','like','%'.$key.'%');
                }
            })->where(function($q) use($starttime){
                if ($starttime != '') {
                    $q->where('created_at','>',$starttime);
                }
            })->where(function($q) use($endtime){
                if ($endtime != '') {
                    $q->where('created_at','<',$endtime);
                }
            })->where(function($q) use($status){
                if ($status != '') {
                    $q->where('status',$status);
                }
            })->where('del',1)->orderBy('id','desc')->paginate(15);
    	return view('admin.huodong.index',compact('title','list','key','starttime','endtime','status'));
    }
    // 添加活动
    public function getAdd()
    {
    	$title = '添加活动';
    	return view('admin.huodong.add',compact('title'));
    }
    public function postAdd(HuodongRequest $req)
    {
    	$data = $req->input('data');
    	Huodong::create($data);
    	return redirect('xyshop/huodong/index')->with('message','添加成功！');
    }
    // 修改活动
    public function getEdit($id = '')
    {
    	$title = '修改活动';
    	$ref = session('backurl');
    	$info = Huodong::findOrFail($id);
    	return view('admin.huodong.edit',compact('title','info','ref'));
    }
    public function postEdit(HuodongRequest $req,$id = '')
    {
    	$data = $req->input('data');
    	Huodong::where('id',$id)->update($data);
    	return redirect($req->ref)->with('message','修改成功！');
    }
    // 删除
    public function getDel($id = '')
    {
    	Huodong::where('id',$id)->update(['del'=>0]);
    	return back()->with('message','删除成功！');
    }
    // 取出来所有活动
    public function getGood(Request $req)
    {
    	$gids = trim($req->gids,'|');
    	$list = Huodong::where('status',1)->where('del',1)->orderBy('id','desc')->paginate(10);
    	return view('admin.huodong.good',compact('list','gids'));
    }
    public function postGood(Request $req)
    {
    	$data = [];
    	// 组合数据
    	$gids = $req->input('data.gids');
    	$hdid = $req->input('data.hdid');
    	foreach (explode('|', $gids) as $v) {
    		$data[] = ['good_id'=>$v,'hd_id'=>$hdid];
    	}
    	// 删除对应的商品数据，再添加进来
    	DB::beginTransaction();
        try {
        	HdGood::whereIn('good_id',explode('|',$gids))->where('hd_id',$hdid)->delete();
        	HdGood::insert($data);
            // 没出错，提交事务
            DB::commit();
            // 跳转回添加的栏目列表
            return back()->with('message','添加成功！');
        } catch (Exception $e) {
            // 出错回滚
            DB::rollBack();
            return back()->with('message','添加失败，请稍后再试！');
        }
    }

    // 下属商品
    public function getGoodlist($id = '')
    {
    	$title = '商品列表';
        // 搜索关键字
		$ids = HdGood::where('hd_id',$id)->pluck('good_id');
		$list = Good::whereIn('id',$ids)->where('status',1)->orderBy('id','desc')->get();
    	return view('admin.huodong.goodlist',compact('title','list','id'));
    }

    // 移除商品
    public function getRmgood($id = '',$gid = '')
    {
    	HdGood::where('hd_id',$id)->where('good_id',$gid)->delete();
    	return back()->with('message','移除成功！');
    }
}
