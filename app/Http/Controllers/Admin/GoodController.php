<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormatRequest;
use App\Http\Requests\GoodRequest;
use App\Models\CateAttr;
use App\Models\Good;
use App\Models\GoodAttr;
use App\Models\GoodCate;
use App\Models\GoodFormat;
use App\Models\Type;
use DB;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    /**
     * 商品列表
     * @return [type] [description]
     */
    public function getIndex(Request $res)
    {
    	$title = '商品列表';
    	$cate_id = $res->input('cate_id');
        // 搜索关键字
        $key = trim($res->input('q',''));
        $starttime = $res->input('starttime');
        $endtime = $res->input('endtime');
        $status = $res->input('status',1);
        $cats = GoodCate::where('status',1)->orderBy('sort','asc')->get();
    	$tree = App::make('com')->toTree($cats,'0');
    	$cate = App::make('com')->toTreeSelect($tree);
		$list = Good::where(function($q) use($cate_id){
                if ($cate_id != '') {
                    $q->where('cate_id',$cate_id);
                }
            })->where(function($q) use($key){
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
            })->orderBy('id','desc')->paginate(15);
    	return view('admin.good.index',compact('title','list','cate','cate_id','key','starttime','endtime','status'));
    }

    /**
     * 添加商品
     * @param  string $catid [栏目ID]
     * @return [type]        [description]
     */
    public function getAdd($id = '0')
    {
    	$title = '添加商品';
    	// 如果catid=0，查出所有栏目，并转成select
    	$cate = '';
    	if($id == '0')
    	{
    		$cats = GoodCate::where('status',1)->orderBy('sort','asc')->get();
	    	$tree = App::make('com')->toTree($cats,'0');
	    	$cate = App::make('com')->toTreeSelect($tree);
    	}
        $tags = Type::where('parentid',9)->get();
    	return view('admin.good.add',compact('title','id','cate','tags'));
    }
    public function postAdd(GoodRequest $res)
    {
        $data = $res->input('data');
        // 开启事务
        DB::beginTransaction();
        try {
            Good::create($data);
            // 没出错，提交事务
            DB::commit();
            // 跳转回添加的栏目列表
            return redirect('/xyshop/good/index?cate_id='.$res->input('data.catid'))->with('message', '添加商品成功！');
        } catch (Exception $e) {
            // 出错回滚
            DB::rollBack();
            return back()->with('message','添加失败，请稍后再试！');
        }
    }

    /**
     * 修改商品
     * @param  string $id [ID]
     * @return [type]        [description]
     */
    public function getEdit($id = '0')
    {
    	$title = '修改商品';
		$cats = GoodCate::where('status',1)->orderBy('sort','asc')->get();
    	$tree = App::make('com')->toTree($cats,'0');
    	$cate = App::make('com')->toTreeSelect($tree);
    	$ref = session('backurl');
    	$info = Good::findOrFail($id);
        $tags = Type::where('parentid',9)->get();
    	return view('admin.good.edit',compact('title','ref','cate','info','tags'));
    }
    public function postEdit(GoodRequest $res,$id)
    {
        $data = $res->input('data');
        // 如果分类变了要删除所有属性重新添加

        // 开启事务
        DB::beginTransaction();
        try {
            Good::where('id',$id)->update($data);
            // 没出错，提交事务
            DB::commit();
            // 跳转回添加的栏目列表
            return redirect($res->ref)->with('message', '修改商品商品成功！');
        } catch (Exception $e) {
            // 出错回滚
            DB::rollBack();
            return back()->with('message','修改失败，请稍后再试！');
        }
    }
    // 删除
    public function getDel($id)
    {
    	Good::where('id',$id)->update(['status'=>0]);
    	return back()->with('message','下架成功！');
    }
    // 属性列表
    public function getFormat($id)
    {
        $title = '属性列表';
        $list = GoodFormat::where('good_id',$id)->where('status',1)->orderBy('id','desc')->paginate(15);
        return view('admin.good.format',compact('title','list','id'));
    }
    // 添加属性
    public function getAddformat($id)
    {
        $title = '添加属性';
        // 找出栏目，找出栏目下属性
        $cid = Good::where('id',$id)->value('cate_id');
        $attrids = CateAttr::where('cate_id',$cid)->pluck('attr_id');
        $attrs = GoodAttr::whereIn('id',$attrids)->get();
        $lists = [];
        foreach ($attrs as $k) {
            $lists[] = ['name'=>$k->name,'unit'=>$k->unit,'value'=>$k->value,'sub'=>GoodAttr::where('parentid',$k->id)->where('status',1)->get()];
        }
        return view('admin.good.addformat',compact('title','lists','id'));
    }
    public function postAddformat(FormatRequest $req,$id)
    {
        $data = $req->input('attr');
        // 组合出名字与值
        $titles = [];
        $values = [];
        foreach ($data as $k => $v) {
            $titles[] = $k;
            $values[] = $v;
        }
        $titles = implode('-', $titles);
        $values = '-'.implode('-', $values).'-';
        // 查一下是否已经有了值的组合
        $hav = GoodFormat::where('attr_ids',$values)->where('good_id',$id)->where('status',1)->first();
        if (!is_null($hav)) {
            return back()->with('message','属性已经存在，修改后再提交！');
        }
        $insert = ['good_id'=>$id,'title'=>$titles,'attr_ids'=>$values,'price'=>$req->input('data.price'),'store'=>$req->input('data.store')];
        GoodFormat::create($insert);
        return redirect('/xyshop/good/format/'.$id)->with('message', '添加商品属性成功！');
    }
    // 修改属性
    public function getEditformat($id)
    {
        $title = '修改属性';
        $info = GoodFormat::findOrFail($id);
        $ref = session('backurl');
        // 找出栏目，找出栏目下属性
        return view('admin.good.editformat',compact('title','info','ref'));
    }
    public function postEditformat(FormatRequest $req,$id)
    {
        $insert = ['price'=>$req->input('data.price'),'store'=>$req->input('data.store')];
        GoodFormat::where('id',$id)->update($insert);
        return redirect($req->ref)->with('message', '修改商品属性成功！');
    }
    // 删除属性
    public function getDelformat($id)
    {
        GoodFormat::where('id',$id)->update(['status'=>0]);
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
                Good::where('id',$v)->update(['sort'=>(int) $sort[$v]]);
            }
            return back()->with('message', '排序成功！');
        }
        else
        {
            return back()->with('message', '请先选择商品！');
        }
    }
    // 批量删除
    public function postAlldel(Request $req)
    {
        $ids = $req->input('sids');
        // 是数组更新数据，不是返回
        if(is_array($ids))
        {
            // 开启事务
            DB::beginTransaction();
            try {
                Good::whereIn('id',$ids)->update(['status'=>0]);
                // 没出错，提交事务
                DB::commit();
                return back()->with('message', '批量删除完成！');
            } catch (Exception $e) {
                // 出错回滚
                DB::rollBack();
                return back()->with('message','删除失败，请稍后再试！');
            }
        }
        else
        {
            return back()->with('message','请选择商品！');
        }
    }
}
