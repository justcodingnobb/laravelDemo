<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoodAttrRequest;
use App\Models\GoodAttr;
use Illuminate\Http\Request;

class GoodAttrController extends Controller
{
    public function getIndex(Request $res,$pid = 0)
    {
    	$title = '商品属性列表';
        $list = GoodAttr::where('parentid',$pid)->where('status',1)->paginate(15);
        return view('admin.goodattr.index',compact('list','title','pid'));
    }

    // 添加商品属性
    public function getAdd($id)
    {
        $title = '添加商品属性';
        return view('admin.goodattr.add',compact('title','id'));
    }

    public function postAdd(GoodAttrRequest $request,$id = 0)
    {
        $data = $request->input('data');
        GoodAttr::create($data);
        return redirect('xyshop/goodattr/index/'.$id)->with('message', '添加商品属性成功！');
    }
    // 修改商品属性
    public function getEdit(Request $req,$id)
    {
        $title = '修改商品属性';
        // 拼接返回用的url参数
        $ref = session('backurl');
        $info = GoodAttr::findOrFail($id);
        return view('admin.goodattr.edit',compact('title','info','ref','id'));
    }
    public function postEdit(GoodAttrRequest $req,$id)
    {
        GoodAttr::where('id',$id)->update($req->input('data'));
        return redirect($req->input('ref'))->with('message', '修改商品属性成功！');
    }
    // 删除商品属性
    public function getDel($id)
    {
    	GoodAttr::where('id',$id)->orWhere('parentid',$id)->update(['status'=>0]);
        return back()->with('message', '商品属性删除成功！');
    }
}
