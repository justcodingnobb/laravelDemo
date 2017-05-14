<?php

namespace App\Http\Controllers\Good;

use App\Http\Controllers\Controller;
use App\Http\Requests\Good\TuanRequest;
use App\Models\Tuan;
use Illuminate\Http\Request;

class TuanController extends Controller
{
    /**
     * 团购管理
     * @return [type] [description]
     */
    public function getIndex(Request $res)
    {
    	$title = '团购管理';
        // 搜索关键字
        $key = trim($res->input('q',''));
        $starttime = $res->input('starttime');
        $endtime = $res->input('endtime');
        $status = $res->input('status');
		$list = Tuan::where(function($q) use($key){
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
    	return view('admin.tuan.index',compact('title','list','key','starttime','endtime','status'));
    }
    // 添加团购
    public function getAdd($id = '')
    {
    	$title = '添加团购';
    	return view('admin.tuan.add',compact('title','id'));
    }
    public function postAdd(TuanRequest $req,$id = '')
    {
    	$data = $req->input('data');
    	Tuan::create($data);
    	return back()->with('message','添加成功！');
    }
    // 修改团购
    public function getEdit($id = '')
    {
    	$title = '修改团购';
    	$ref = session('backurl');
    	$info = Tuan::with('good')->findOrFail($id);
    	return view('admin.tuan.edit',compact('title','info','ref'));
    }
    public function postEdit(TuanRequest $req,$id = '')
    {
    	$data = $req->input('data');
    	Tuan::where('id',$id)->update($data);
    	return redirect($req->ref)->with('message','修改成功！');
    }
    // 删除
    public function getDel($id = '')
    {
    	Tuan::where('id',$id)->update(['del'=>0]);
    	return back()->with('message','删除成功！');
    }
}
