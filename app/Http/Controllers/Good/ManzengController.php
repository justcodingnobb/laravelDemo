<?php

namespace App\Http\Controllers\Good;

use App\Http\Controllers\Controller;
use App\Http\Requests\Good\ManzengRequest;
use App\Models\Manzeng;
use Illuminate\Http\Request;

class ManzengController extends Controller
{
    /**
     * 满赠管理
     * @return [type] [description]
     */
    public function getIndex(Request $res)
    {
    	$title = '满赠管理';
        // 搜索关键字
        $key = trim($res->input('q',''));
        $starttime = $res->input('starttime');
        $endtime = $res->input('endtime');
        $status = $res->input('status');
		$list = Manzeng::where(function($q) use($key){
                if ($key != '') {
                    $q->where('title','like','%'.$key.'%');
                }
            })->where(function($q) use($starttime,$endtime){
                if ($starttime != '' && $endtime != '') {
                    $q->where('starttime','>=',$starttime)->where('starttime','<=',$endtime);
                }
            })->where(function($q) use($status){
                if ($status != '') {
                    $q->where('status',$status);
                }
            })->where('del',1)->orderBy('id','desc')->paginate(15);
    	return view('admin.manzeng.index',compact('title','list','key','starttime','endtime','status'));
    }
    // 添加满赠
    public function getAdd($id = '')
    {
    	$title = '添加满赠';
    	return view('admin.manzeng.add',compact('title','id'));
    }
    public function postAdd(ManzengRequest $req,$id = '')
    {
    	$data = $req->input('data');
    	Manzeng::create($data);
    	return back()->with('message','添加成功！');
    }
    // 修改满赠
    public function getEdit($id = '')
    {
    	$title = '修改满赠';
    	$ref = session('backurl');
    	$info = Manzeng::with('good')->findOrFail($id);
    	return view('admin.manzeng.edit',compact('title','info','ref'));
    }
    public function postEdit(ManzengRequest $req,$id = '')
    {
    	$data = $req->input('data');
    	Manzeng::where('id',$id)->update($data);
    	return redirect($req->ref)->with('message','修改成功！');
    }
    // 删除
    public function getDel($id = '')
    {
    	Manzeng::where('id',$id)->update(['del'=>0]);
    	return back()->with('message','删除成功！');
    }
}
