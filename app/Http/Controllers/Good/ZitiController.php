<?php

namespace App\Http\Controllers\Good;

use App\Http\Controllers\Controller;
use App\Http\Requests\Good\ZitiRequest;
use App\Models\Type;
use App\Models\Zitidian;
use Illuminate\Http\Request;

class ZitiController extends Controller
{
    /**
     * 自提管理
     * @return [type] [description]
     */
    public function getIndex(Request $res)
    {
    	$title = '自提管理';
        // 搜索关键字
        $key = trim($res->input('q',''));
        $starttime = $res->input('starttime');
        $endtime = $res->input('endtime');
        $status = $res->input('status');
		$list = Zitidian::where(function($q) use($key){
                if ($key != '') {
                    $q->where('address','like','%'.$key.'%');
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
    	return view('admin.ziti.index',compact('title','list','key','starttime','endtime','status'));
    }
    // 添加自提
    public function getAdd()
    {
    	$title = '添加自提';
        $area = Type::where('parentid',4)->get();
    	return view('admin.ziti.add',compact('title','area'));
    }
    public function postAdd(ZitiRequest $req)
    {
    	$data = $req->input('data');
    	Zitidian::create($data);
    	return redirect('xyshop/ziti/index')->with('message','添加成功！');
    }
    // 修改自提
    public function getEdit($id = '')
    {
    	$title = '修改自提';
    	$ref = session('backurl');
        $area = Type::where('parentid',4)->get();
    	$info = Zitidian::findOrFail($id);
    	return view('admin.ziti.edit',compact('title','info','ref','area'));
    }
    public function postEdit(ZitiRequest $req,$id = '')
    {
    	$data = $req->input('data');
    	Zitidian::where('id',$id)->update($data);
    	return redirect($req->ref)->with('message','修改成功！');
    }
    // 删除
    public function getDel($id = '')
    {
    	Zitidian::where('id',$id)->update(['del'=>0]);
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
                Zitidian::where('id',$v)->update(['sort'=>(int) $sort[$v]]);
            }
            return back()->with('message', '排序成功！');
        }
        else
        {
            return back()->with('message', '请先选择自提！');
        }
    }
}
