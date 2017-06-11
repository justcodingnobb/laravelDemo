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
use App\Models\GoodSpec;
use App\Models\GoodSpecItem;
use App\Models\GoodSpecPrice;
use App\Models\GoodsAttr;
use App\Models\Type;
use DB;
use Illuminate\Http\Request;
use Storage;

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
            $good = Good::create($data);
            $date = date('Y-m-d H:i:s');
            // 规格对应的值
            $spec_item = $res->input('spec_item');
            $tmp_spec = [];
            foreach ($spec_item as $sk => $sv) {
                $tmp_spec[] = ['good_id'=>$good->id,'key'=>$sk,'key_name'=>$sv['key_name'],'price'=>$sv['price'],'store'=>$sv['store'],'created_at'=>$date,'updated_at'=>$date];
            }
            // 属性对应的值
            $good_attr = $res->input('good_attr');
            $tmp_attr = [];
            foreach ($good_attr as $ak => $av) {
                $tmp_attr[] = ['good_id'=>$good->id,'good_attr_id'=>$ak,'good_attr_value'=>json_encode($av),'created_at'=>$date,'updated_at'=>$date];
            }
            GoodSpecPrice::insert($tmp_spec);
            GoodsAttr::insert($tmp_attr);
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
        // 开启事务
        DB::beginTransaction();
        try {
            Good::where('id',$id)->update($data);
            $date = date('Y-m-d H:i:s');
            // 如果分类变了要删除所有属性重新添加
            // 规格对应的值
            GoodSpecPrice::where('good_id',$id)->delete();
            $spec_item = $res->input('spec_item');
            $tmp_spec = [];
            foreach ($spec_item as $sk => $sv) {
                $tmp_spec[] = ['good_id'=>$id,'key'=>$sk,'key_name'=>$sv['key_name'],'price'=>$sv['price'],'store'=>$sv['store'],'created_at'=>$date,'updated_at'=>$date];
            }
            // 属性对应的值
            GoodsAttr::where('good_id',$id)->delete();
            $good_attr = $res->input('good_attr');
            $tmp_attr = [];
            foreach ($good_attr as $ak => $av) {
                $tmp_attr[] = ['good_id'=>$id,'good_attr_id'=>$ak,'good_attr_value'=>json_encode($av),'created_at'=>$date,'updated_at'=>$date];
            }
            GoodSpecPrice::insert($tmp_spec);
            GoodsAttr::insert($tmp_attr);
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

    // 取商品分类下规格
    public function getGoodSpec(Request $req)
    {
        $cid = $req->cid;
        $good_id = $req->good_id;
        $list = GoodSpec::with('goodspecitem')->where('good_cate_id',$cid)->orderBy('id')->get();
        // 查出来所有的规格ID
        $items_id = GoodSpecPrice::where('good_id',$good_id)->pluck('key');
        $items_ids = [];
        $items_id = $items_id->unique();
        foreach ($items_id as $t) {
            $items_ids = array_merge($items_ids,explode('_',$t));
        }
        $items_ids = array_unique($items_ids);
        return view('admin.good.goodspec',compact('list','items_ids'));
    }
    // 取商品分类下属性
    public function getGoodAttr(Request $req)
    {
        $cid = $req->cid;
        $good_id = $req->good_id;
        $list = GoodAttr::where('good_cate_id',$cid)->orderBy('id')->get();
        // 查出来所有的属性值及ID
        $good_attrs = GoodsAttr::where('good_id',$good_id)->get()->keyBy('good_attr_id')->toArray();
        return view('admin.good.goodattr',compact('list','good_attrs'));
    }
    /**
     * 动态获取商品规格输入框 根据不同的数据返回不同的输入框
     * 获取 规格的 笛卡尔积
     * @param $goods_id 商品 id     
     * @param $spec_arr 笛卡尔积
     * @return string 返回表格字符串
     */
    public function postGoodSpecInput(Request $req){
        try {
            $goods_id = isset(($req->all())['goods_id']) ? ($req->all())['goods_id'] : 0;
            $spec_arr = isset(($req->all())['spec_arr']) ? ($req->all())['spec_arr'] : [[]];

            // 排序
            foreach ($spec_arr as $k => $v)
            {
                $spec_arr_sort[$k] = count($v);
            }
            asort($spec_arr_sort);        
            foreach ($spec_arr_sort as $key =>$val)
            {
                $spec_arr2[$key] = $spec_arr[$key];
            }
            
            $clo_name = array_keys($spec_arr2);
            $spec_arr2 = app('com')->combineDika($spec_arr2); //  获取 规格的 笛卡尔积                 
                       
            $spec = GoodSpec::select('id','name')->get()->keyBy('id')->toArray(); // 规格表
            $specItem = GoodSpecItem::get()->keyBy('id')->toArray();    //规格项
            $keySpecGoodsPrice = GoodSpecPrice::where('good_id',$goods_id)->select('key','key_name','price','store')->get()->keyBy('key')->toArray();//规格项

           $str = "<table class='table table-bordered' id='spec_input_tab'>";
           $str .="<tr>";       
           // 显示第一行的数据
            foreach ($clo_name as $k => $v) 
            {
                if ($v != 0) {
                    $str .=" <td><b>".$spec[$v]['name']."</b></td>";
                }
            }    
            $str .="<td><b>价格</b></td>
                   <td><b>库存</b></td>
                 </tr>";
           // 显示第二行开始 
           foreach ($spec_arr2 as $k => $v) 
           {
                $str .="<tr>";
                $item_key_name = array();
                foreach($v as $k2 => $v2)
                {
                    $str .="<td>".$specItem[$v2]['item']."</td>";
                    $item_key_name[$v2] = $spec[$specItem[$v2]['good_spec_id']]['name'].':'.$specItem[$v2]['item'];
                }   
                ksort($item_key_name);            
                $item_key = implode('_', array_keys($item_key_name));
                $item_name = implode(' ', $item_key_name);
                
                $keySpecGoodsPrice[$item_key]['price'] = isset($keySpecGoodsPrice[$item_key]['price']) ? $keySpecGoodsPrice[$item_key]['price'] : 0; // 价格默认为0
                $keySpecGoodsPrice[$item_key]['store'] = isset($keySpecGoodsPrice[$item_key]['store']) ? $keySpecGoodsPrice[$item_key]['store'] : 0; //库存默认为0
                $str .="<td><input name='spec_item[$item_key][price]' class='form-control' value='{$keySpecGoodsPrice[$item_key]['price']}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")' /></td>";
                $str .="<td><input name='spec_item[$item_key][store]' class='form-control' value='{$keySpecGoodsPrice[$item_key]['store']}' onkeyup='this.value=this.value.replace(/[^\d.]/g,\"\")' onpaste='this.value=this.value.replace(/[^\d.]/g,\"\")'/>
                    <input type='hidden' name='spec_item[$item_key][key_name]' value='$item_name' /></td>";
                $str .="</tr>";           
           }
            $str .= "</table>";
            exit($str);
        } catch (\Exception $e) {
            exit($e->getLine().' - '.$e->getMessage());
        }
    }
}
