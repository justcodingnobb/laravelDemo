<?php

namespace App\Http\Controllers\Old;

use App;
use App\Http\Controllers\BaseController;
use App\Models\Cart;
use App\Models\CateAttr;
use App\Models\Good;
use App\Models\GoodAttr;
use App\Models\GoodCate;
use App\Models\GoodFormat;
use App\Models\Order;
use App\Models\OrderGood;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ShopController extends BaseController
{
    /*
     * 分类页面
     * 添加筛选功能 
     */
    public function goodcate($id = 0,$format = '')
    {
        $info = GoodCate::findOrFail($id);
        $info->pid = $info->parentid == 0 ? $info->id : $info->parentid;
        // 找出所有子分类来
        $subcate = GoodCate::where('parentid',$id)->where('status',1)->orderBy('sort','asc')->get();
        // 找商品的属性
        $attrs = CateAttr::where('cate_id',$id)->pluck('attr_id');
        // 对应的属性及值，循环取下一级
        $attr_p = GoodAttr::whereIn('id',$attrs)->where('status',1)->orderBy('id','asc')->get();
        foreach ($attr_p as $k => $v) {
        	$attr_p[$k]['child'] = GoodAttr::where('parentid',$v->id)->where('status',1)->orderBy('id','asc')->get();
        }

        // 生成筛选用的url及参数
        // 这里是取现在url里的参数值，是个关键点
        $filter_attr = $format == '' ? '' : explode('.', trim($format));
        // 建立返回的空数组
        $all_attr_list = array();
        // 开始外部大属性循环
        foreach ($attr_p as $k => $v) {
            $temp_name = $v['name'];
            //获取该属性名（主属性）
            $all_attr_list[$k]['filter_attr_name'] = $temp_name;

            //如果后台指定该分类下，用于搜索的属性的组数，是跟地址栏中filter_attr=0.0.0.0 中0的个数是一样的，而且顺序都是一样的即：第一个0，表示第一组属性中，它选择了哪一个子属性，以此类推
            //获取当前url中已选择属性的值，并保留在数组中。!这里要作循环，是因为避免属性为0或者空时，导致出错，因为直接把$filter_attr 赋值给 $temp_arrt_url_arr会出错。
            $temp_arrt_url_arr = array();
            $attr_p_num = $attr_p->count();
            for ($i = 0; $i < $attr_p_num; $i++) {
                $temp_arrt_url_arr[$i] = !empty($filter_attr[$i]) ? $filter_attr[$i] : 0;
            }
            $temp_attr = $temp_arrt_url_arr;
            //“全部”的信息生成
            $temp_arrt_url_arr[$k] = 0;
            $temp_arrt_url = implode('.', $temp_arrt_url_arr);
            $all_attr_list[$k]['attr_list'][0]['attr_value'] = '全部';
            // 这里生成url的过程也是关键点，代码里只展示了属性数据里的，并没有添加其它固定的筛选项
            $all_attr_list[$k]['attr_list'][0]['url'] = url('/shop/cate', array('id'=>$id,'format'=>$temp_arrt_url));
            $all_attr_list[$k]['attr_list'][0]['selected'] = empty($filter_attr[$k]) ? 1 : 0;

            // 取所有的子属性
            $attr_list = $v['child'];
            // 子属性的生成
            foreach ($attr_list as $ks => $vv) {
                $temp_k = $ks + 1;
                //为url中代表当前筛选属性的位置变量赋值,并生成以‘.’分隔的筛选属性字符串
                $temp_arrt_url_arr[$k] = $vv['id'];
                $temp_arrt_url = implode('.', $temp_arrt_url_arr);

                $all_attr_list[$k]['attr_list'][$temp_k]['attr_value'] = $vv['value'];
                $all_attr_list[$k]['attr_list'][$temp_k]['url'] = url('/shop/cate', array('id'=>$id,'format'=>$temp_arrt_url));

                //处理已被选择的子属性
                if (!empty($filter_attr[$k]) && $filter_attr[$k] == $vv['id']) {
                    $all_attr_list[$k]['attr_list'][$temp_k]['selected'] = 1;
                }
                else {
                    $all_attr_list[$k]['attr_list'][$temp_k]['selected'] = 0;
                }
            }
        }
        // 找出属性来，循环找，如果是0，则忽略
        $attr_vals = '-';
        $ids = [];
        if (isset($temp_attr)) {
            foreach ($temp_attr as $k => $t) {
                if($t != 0)
                {
                    $attr_vals .= $t.'.';
                }
            }
            $attr_vals = str_replace('.', '-', $attr_vals);
            // 如果有筛选值，先找出ID来
            if (trim($attr_vals,'-') != '') {
                $ids = GoodFormat::where('attr_ids','like',"%$attr_vals%")->where('status',1)->pluck('good_id');
            }
        }
        // 找出所有商品来，同时筛选
        $list = Good::where('status',1)->where(function($q) use($ids,$attr_vals){
            if (trim($attr_vals,'-') != '') {
                $q->whereIn('id',$ids);
            }
        })->whereIn('cate_id',explode(',',$info->arrchildid))->paginate(15);
        return view($this->theme.'.goodcate',compact('list','subcate','info','all_attr_list','format'));
    }
    /*
     * 当传了属性时，按属性值计算，没传时按第一个计算
     */
    public function good($id = '',$format='')
    {
        $info = Good::with(['goodcate','format'])->findOrFail($id);
        $info->pid = $info->goodcate->parentid == 0 ? $info->catid : $info->goodcate->parentid;
        // 有属性信息的时候，优先查属性信息
        $formats = GoodFormat::where('good_id',$id)->where('status',1)->orderBy('id','asc')->get();
        // 找出属性来，循环找，如果是0，则忽略
        $format = $format == '' ? '' : explode('.', trim($format));
        $attr_vals = '-';
        // 没有这个参数时
        if($format != '')
        {
            $temp_arrt_url_arr = array();
            // 对应的属性及值，循环取下一级
            // 找商品的属性
            $attrs = CateAttr::where('cate_id',$info->cate_id)->pluck('attr_id');
            $attr_p = GoodAttr::whereIn('id',$attrs)->where('status',1)->orderBy('id','asc')->get()->count();
            for ($i = 0; $i < $attr_p; $i++) {
                $temp_arrt_url_arr[$i] = !empty($format[$i]) ? $format[$i] : 0;
            }
            foreach ($temp_arrt_url_arr as $k => $t) {
                if($t != 0)
                {
                    $attr_vals .= $t.'.';
                }
            }
            $attr_vals = str_replace('.', '-', $attr_vals);
        }
        if(trim($attr_vals,'-') != '')
        {
            $good_format = GoodFormat::where('attr_ids','like',"%$attr_vals%")->where('good_id',$id)->where('status',1)->orderBy('id','asc')->first();
        }
        else
        {
    	    if (is_null($formats)) {
    	    	$good_format = null;
    	    }
            else
            {
                $good_format = $formats->first();
            }
        }
        // 循环生成属性的URL
        foreach ($formats as $k => $f) {
            $formats[$k]['format'] = $tmp_ids = str_replace('-','.',trim($f->attr_ids,'-'));
            // 找出来对应的属性值以显示
            $tmp_value = GoodAttr::whereIn('id',explode('.',$tmp_ids))->where('status',1)->pluck('value')->toArray();
            $formats[$k]['value'] = implode('-',$tmp_value);
        }
        return view($this->theme.'.good',compact('info','formats','good_format'));
    }
    // 购物车
    public function cart()
    {
        // 找出购物车
        $goods = Cart::where(function($q){
                if (!is_null(session('member'))) {
                    $q->where('user_id',session('member')->id);
                }
                else
                {
                    $q->where('session_id',session()->getId());
                }
            })->orderBy('updated_at','desc')->get();
        $goodlists = [];
        $total_prices = 0;
        // 缓存属性们
        $attrs = GoodAttr::get();
        // 如果有购物车
        $goods = $goods->toArray();
        // 循环查商品，方便带出属性来
        foreach ($goods as $k => $v) {
            $goodlists[$k] = Good::where('id',$v['good_id'])->where('status',1)->first();
            $goodlists[$k]['num'] = $v['nums'];
            $goodlists[$k]['price'] = $v['price'];
            $tmp_total_price = number_format($v['nums'] * $v['price'],2,'.','');
            $goodlists[$k]['total_prices'] = $tmp_total_price;
            $total_prices += $tmp_total_price;
            // 如果属性值不为0，查属性值
            if ($v['format_id']) {
                $tmp_format = GoodFormat::where('id',$v['format_id'])->value('attr_ids');
                $tmp_format = str_replace('-','.',trim($tmp_format,'-'));
                $tmp_format_name = $attrs->whereIn('id',explode('.',$tmp_format))->pluck('value')->toArray();
                $goodlists[$k]['format'] = ['fid'=>$v['format_id'],'format'=>$tmp_format,'format_name'=>implode('-',$tmp_format_name)];
            }
            else
            {
                $goodlists[$k]['format'] = ['fid'=>0,'format'=>'','format_name'=>''];
            }
        }
        // 找出所有商品来
        $info = (object) ['pid'=>0];
        $total_prices = number_format($total_prices,2,'.','');
        return view($this->theme.'.cart',compact('goods','goodlists','info','total_prices'));
    }
    // 提交订单
    public function getAddorder(Request $req)
    {
        // 找出所有 购物车
        $ids = Cart::where('user_id',session('member')->id)->orderBy('updated_at','desc')->get();
        if ($ids->count() == 0) {
            return back()->with('message','购物车里是空的，请先购物！');
        }
        // 所有产品总价
        $prices = Cart::where('user_id',session('member')->id)->sum('total_prices');
        $uid = session('member')->id;
        // 创建订单
        $order_id = App::make('com')->orderid();
        $order = ['order_id'=>$order_id,'user_id'=>$uid,'total_prices'=>$prices,'create_ip'=>$req->ip()];
        // 事务
        DB::beginTransaction();
        try {
            $oid = Order::create($order);
            // 组合order_goods数组
            $order_goods = [];
            $clear_ids = [];
            foreach ($ids as $k => $v) {
                $order_goods[$k] = ['user_id'=>$uid,'order_id'=>$oid->id,'good_id'=>$v->good_id,'format_id'=>$v->format_id,'nums'=>$v->nums,'price'=>$v->price,'total_prices'=>$v->total_prices,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()];
                $clear_ids[] = $v->id;
            }
            // 插入
            OrderGood::insert($order_goods);
            // 没出错，提交事务
            DB::commit();
            // 清空购物车里的这几个产品
            Cart::whereIn('id',$clear_ids)->delete();
            $info = (object)['pid'=>0];
            $oid = $oid->id;
            return view($this->theme.'.addorder',compact('info','oid'));
        } catch (\Exception $e) {
            // 出错回滚
            DB::rollBack();
            return back()->with('message','添加失败，请稍后再试！');
        }
        // return view('shop.cart',compact('seo','goodcateid','pcatid','goods','goodlists'));
    }
    // 订单列表
    public function order(Request $req)
    {
        $info = (object) ['pid'=>0];
        // 找出订单
        $orders = Order::with(['good'=>function($q){
                    $q->with('good');
                }])->where('user_id',session('member')->id)->orderBy('id','desc')->paginate(10);
        // 缓存属性们
        $attrs = GoodAttr::get();
        // 如果有购物车
        $goodlists = [];
        // 循环查商品，方便带出属性来
        foreach ($orders as $k => $v) {
            // 如果属性值不为0，查属性值
            foreach ($v->good as $key => $value) {
                if ($value->format_id) {
                    $tmp_format = GoodFormat::where('id',$value['format_id'])->value('attr_ids');
                    $tmp_format = str_replace('-','.',trim($tmp_format,'-'));
                    $tmp_format_name = $attrs->whereIn('id',explode('.',$tmp_format))->pluck('value')->toArray();
                    $good_format = ['fid'=>$v['format_id'],'format'=>$tmp_format,'format_name'=>implode('-',$tmp_format_name)];
                }
                else
                {
                    $good_format = ['fid'=>0,'format'=>'','format_name'=>''];
                }
                $value->format = $good_format;
            }
        }
        return view($this->theme.'.order',compact('info','orders'));

    }
    // 添加购物车
    public function getAddcart(Request $req)
    {
        // 先清除一天以上的无用购物车
        Cart::where('user_id',0)->where('updated_at','<',Carbon::now()->subday())->delete();
        // 清除完成
        $sid = session()->getId();
        $id = $req->gid;
        $formatid = $req->fid;
        $num = $req->num;
        if ($num < 1) {
            return back()->with('message','请选择购买数量！');
        }
        $price = $req->gp;
        // 如果用户已经登陆，查以前的购物车
        if (session()->has('member')) {
            // 当前用户此次登陆添加的
            $tmp = Cart::where('session_id',$sid)->where('user_id',session('member')->id)->where('good_id',$id)->where('format_id',$formatid)->orderBy('id','desc')->first();
            // 如果没有，看以前有没有添加过这类商品
            if(is_null($tmp))
            {
                $tmp = Cart::where('user_id',session('member')->id)->where('good_id',$id)->where('format_id',$formatid)->orderBy('id','desc')->first();
            }
        }
        else
        {
            $tmp = Cart::where('session_id',$sid)->where('good_id',$id)->where('format_id',$formatid)->orderBy('id','desc')->first();
        }
        // 查看有没有在购物车里，有累计数量
        if (!is_null($tmp)) {
            $nums = $num + $tmp->nums;
        }
        else
        {
            $nums = $num;
        }
        $userid = !is_null(session('member')) ? session('member')->id : 0;
        $total_prices = $price * $nums;
        $a = ['session_id'=>$sid,'user_id'=>$userid,'good_id'=>$id,'format_id'=>$formatid,'nums'=>$nums,'price'=>$price,'total_prices'=>$total_prices];
        // 查看有没有在购物车里，有累计数量
        if (!is_null($tmp)) {
            Cart::where('id',$tmp->id)->update($a);
        }
        else
        {
            Cart::create($a);
        }
        // 找出所有商品来
        $info = (object) ['pid'=>0];
        return view($this->theme.'.addcart',compact('info'));
    }
    // 修改数量
    public function postChangecart(Request $req)
    {
        try {
            $id = $req->gid;
            $fid = $req->fid;
            $num = $req->num < 1 ? 1 : $req->num;
            $price = $req->price;
            Cart::where('session_id',session()->getId())->where('good_id',$id)->where('format_id',$fid)->update(['nums'=>$num,'total_prices'=>$num * $price]);
            echo $num;
        } catch (\Exception $e) {
            echo 0;
        }
    }
    // 移除
    public function postRemovecart(Request $req)
    {
        try {
            $id = $req->id;
            $fid = $req->fid;
            Cart::where('session_id',session()->getId())->where('good_id',$id)->where('format_id',$fid)->delete();
            echo 1;
        } catch (\Exception $e) {
            echo 0;
        }
    }
    // 取购物车数量
    public function cartnums()
    {
        if (is_null(session('member'))) {
            $tmp = Cart::where('session_id',session()->getId())->sum('nums');
        }
        else
        {
            $tmp = Cart::where('user_id',session('member')->id)->sum('nums');
        }
        echo $tmp;
    }
}
