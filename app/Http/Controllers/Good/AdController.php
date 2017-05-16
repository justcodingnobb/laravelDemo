<?php

namespace App\Http\Controllers\Good;

use App\Http\Controllers\Controller;
use App\Http\Requests\Good\AdRequest;
use App\Models\Ad;
use App\Models\Type;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * 广告管理
     * @return [type] [description]
     */
    public function getIndex(Request $res)
    {
    	$title = '广告管理';
        // 搜索关键字
        $key = trim($res->input('q',''));
        $starttime = $res->input('starttime');
        $endtime = $res->input('endtime');
        $status = $res->input('status');
		$list = Ad::where(function($q) use($key){
                if ($key != '') {
                    $q->where('title','like','%'.$key.'%');
                }
            })->where(function($q) use($starttime,$endtime){
                if ($starttime != '' && $endtime != '') {
                    $q->where('created_at','>=',$starttime)->where('created_at','<=',$endtime);
                }
            })->where(function($q) use($status){
                if ($status != '') {
                    $q->where('status',$status);
                }
            })->where('del',1)->orderBy('id','desc')->paginate(15);
    	return view('admin.ad.index',compact('title','list','key','starttime','endtime','status'));
    }
    // 添加广告
    public function getAdd($id = '')
    {
    	$title = '添加广告';
    	$pos = Type::where('parentid',1)->orderBy('listorder','asc')->orderBy('id','asc')->get();
    	return view('admin.ad.add',compact('title','id','pos'));
    }
    public function postAdd(AdRequest $req,$id = '')
    {
    	$data = $req->input('data');
    	Ad::create($data);
    	return redirect('xyshop/ad/index')->with('message','添加成功！');
    }
    // 修改广告
    public function getEdit($id = '')
    {
    	$title = '修改广告';
    	$ref = session('backurl');
    	$pos = Type::where('parentid',1)->orderBy('listorder','asc')->orderBy('id','asc')->get();
    	$info = Ad::findOrFail($id);
    	return view('admin.ad.edit',compact('title','info','ref','pos'));
    }
    public function postEdit(AdRequest $req,$id = '')
    {
    	$data = $req->input('data');
    	Ad::where('id',$id)->update($data);
    	return redirect($req->ref)->with('message','修改成功！');
    }
    // 删除
    public function getDel($id = '')
    {
    	Ad::where('id',$id)->update(['del'=>0]);
    	return back()->with('message','删除成功！');
    }
    // 排序
    public function postSort(Request $req)
    {
        $ids = $req->input('sids');
        $sort = $req->input('sort');
        if (is_array($ids))
        {
            foreach ($ids as $v) {
                Ad::where('id',$v)->update(['sort'=>(int) $sort[$v]]);
            }
            return back()->with('message', '排序成功！');
        }
        else
        {
            return back()->with('message', '请先选择广告！');
        }
    }
    // 批量删除
    public function postAlldel(Request $req)
    {
        $ids = $req->input('sids');
        // 是数组更新数据，不是返回
        if(is_array($ids))
        {
            Ad::whereIn('id',$ids)->update(['del'=>0]);
            return back()->with('message', '批量删除完成！');
        }
        else
        {
            return back()->with('message','请选择广告！');
        }
    }
}
