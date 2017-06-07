<?php

namespace App\Http\Controllers;

use App;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Good\GoodCommentRequest;
use App\Models\Ad;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CateAttr;
use App\Models\Good;
use App\Models\GoodAttr;
use App\Models\GoodCate;
use App\Models\GoodComment;
use App\Models\GoodFormat;
use App\Models\Manzeng;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Pay;
use App\Models\User;
use App\Models\YhqUser;
use App\Models\Zitidian;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ShopController extends BaseController
{
    /*
     * 分类页面
     * 添加筛选功能 
     */
    public function getGoodcate(Request $req,$id = 0)
    {   
        // 如果没有标明分类，取第一个
        if ($id == 0) {
            $info = GoodCate::where('parentid',0)->where('status',1)->orderBy('sort','asc')->orderBy('id','asc')->first();
        }
        else
        {
            $info = GoodCate::findOrFail($id);
        }
        // 如果是一级分类，打开分类列表，如果是二级分类打开产品列表
        if ($info->parentid == 0) {
            // 找出所有的一级分类来
            $allcate = GoodCate::where('parentid',0)->where('status',1)->orderBy('sort','asc')->orderBy('id','asc')->get();
            // 找当前分类的所有子分类
            $childid = explode(',',$info->arrchildid);
            unset($childid[0]);
            $subcate = GoodCate::whereIn('id',$childid)->where('status',1)->orderBy('sort','asc')->orderBy('id','asc')->get();
            // 找出来广告们
            $info->pid = 2;
            $ad = Ad::where('pos_id',8)->where('status',1)->where('del',1)->get()->random();
            return view($this->theme.'.goodcate',compact('info','allcate','subcate','ad'));
        }
        else
        {
            $info->pid = 2;
            $sort = isset($req->sort) ? $req->sort : 'sort';
            $sc = isset($req->sc) ? $req->sc : 'asc';
            $list = Good::where('cate_id',$id)->orderBy($sort,$sc)->orderBy('id','desc')->simplePaginate(20);
            switch ($sort) {
                case 'sales':
                    $active = 2;
                    break;

                case 'id':
                    $active = 3;
                    break;

                case 'price':
                    $active = 4;
                    break;
                
                default:
                    $active = 1;
                    break;
            }
            return view($this->theme.'.goodlist',compact('info','list','active','sort','sc'));
        }
    }
    /*
     * 当传了属性时，按属性值计算，没传时按第一个计算
     */
    public function getGood($id = '',$format='')
    {

        $info = Good::with(['goodcate','format'])->findOrFail($id);
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
        $tmp_formats = GoodAttr::where('status',1)->get();
        foreach ($formats as $k => $f) {
            $formats[$k]['format'] = $tmp_ids = str_replace('-','.',trim($f->attr_ids,'-'));
            // 找出来对应的属性值以显示
            $tmp_value = $tmp_formats->whereIn('id',explode('.',$tmp_ids))->pluck('value')->toArray();
            $formats[$k]['value'] = implode('-',$tmp_value);
        }
        $info->pid = 0;
        // 取评价，20条
        $goodcomment = GoodComment::with(['user'=>function($q){
                $q->select('id','nickname','thumb','username');
            }])->where('good_id',$id)->where('del',1)->orderBy('id','desc')->limit(20)->get();
        return view($this->theme.'.good',compact('info','formats','good_format','goodcomment'));
    }
    // 购物车
    public function getCart()
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
        $formats = GoodFormat::where('status',1)->get();
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
                $tmp_format = $formats->where('id',$v['format_id'])->first();
                if (is_null($tmp_format)) {
                    $tmp_format = '';
                    $tmp_format_name = '';
                }
                else
                {
                    $tmp_format = str_replace('-','.',trim($tmp_format->attr_ids,'-'));
                    $tmp_format_tmp = explode('.',$tmp_format);
                    $tmp_format_name = $attrs->whereIn('id',$tmp_format_tmp)->pluck('value')->toArray();
                    // 添加上单位
                    foreach ($tmp_format_name as $kk => $vv) {
                        $tmp_format_name[$kk] = $vv.$attrs->where('id',$tmp_format_tmp[$kk])->first()->unit;
                    }
                }
                $goodlists[$k]['format'] = ['fid'=>$v['format_id'],'format'=>$tmp_format,'format_name'=>implode('-',$tmp_format_name)];
            }
            else
            {
                $goodlists[$k]['format'] = ['fid'=>0,'format'=>'','format_name'=>''];
            }
        }
        // 找出所有商品来
        $info = (object) ['pid'=>3];
        $total_prices = number_format($total_prices,2,'.','');
        // 查此用户的所有可用优惠券
        $yhq = YhqUser::with('yhq')->where('user_id',session('member')->id)->where('endtime','>',date('Y-m-d H:i:s'))->where('status',1)->where('del',1)->get();
        // 送货地址
        $address = Address::where('user_id',session('member')->id)->where('del',1)->get();
        // 满赠列表
        $mz = Manzeng::with(['good'=>function($q){
                $q->select('id','title');
            }])->where('status',1)->where('del',1)->orderBy('sort','asc')->orderBy('price','asc')->get();
        // 自提点
        $ziti = Zitidian::where('status',1)->where('del',1)->orderBy('sort','asc')->get();
        return view($this->theme.'.cart',compact('goods','goodlists','info','total_prices','yhq','address','mz','ziti'));
    }
    // 提交订单
    public function getAddorder(Request $req)
    {
        // 判断是否选择送货地址
        if (!isset($req->aid) || !isset($req->ziti)) {
            return back()->with('message','请选择送货地址！');
        }
        // 找出所有 购物车
        $ids = Cart::where('user_id',session('member')->id)->orderBy('updated_at','desc')->get();
        if ($ids->count() == 0) {
            return back()->with('message','购物车里是空的，请先购物！');
        }
        // 所有产品总价
        $old_prices = Cart::where('user_id',session('member')->id)->sum('total_prices');
        $uid = session('member')->id;
        // 创建订单
        $order_id = app('com')->orderid();
        // 查出优惠券优惠多少
        $yh_price = 0;
        $prices = $old_prices;
        $yhq_id = isset($req->yid) ? $req->yid : 0;
        if ($yhq_id) {
            $yh = YhqUser::where('id',$req->yid)->first();
            $yh_price = $yh->yhq->lessprice;
            $prices = $old_prices - $yh_price;
        }
        $area = Address::where('id',$req->aid)->value('area');
        $order = ['order_id'=>$order_id,'user_id'=>$uid,'yhq_id'=>$yhq_id,'yh_price'=>$yh_price,'old_prices'=>$old_prices,'total_prices'=>$prices,'create_ip'=>$req->ip(),'address_id'=>$req->aid,'ziti'=>$req->ziti,'area'=>$area];
        // 事务
        DB::beginTransaction();
        try {
            $order = Order::create($order);
            // 组合order_goods数组
            $order_goods = [];
            $clear_ids = [];
            foreach ($ids as $k => $v) {
                $order_goods[$k] = ['user_id'=>$uid,'order_id'=>$order->id,'good_id'=>$v->good_id,'format_id'=>$v->format_id,'nums'=>$v->nums,'price'=>$v->price,'total_prices'=>$v->total_prices,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()];
                $clear_ids[] = $v->id;
            }
            // 插入
            OrderGood::insert($order_goods);
            // 没出错，提交事务
            DB::commit();
            // 清空购物车里的这几个产品
            Cart::whereIn('id',$clear_ids)->delete();
            $info = (object)['pid'=>3];

            $paylist = Pay::where('status',1)->where('paystatus',1)->orderBy('id','asc')->get();

            return view($this->theme.'.addorder',compact('info','order','paylist'));
        } catch (\Exception $e) {
            // 出错回滚
            DB::rollBack();
            return back()->with('message','添加失败，请稍后再试！');
        }
        // return view('shop.cart',compact('seo','goodcateid','pcatid','goods','goodlists'));
    }
    // 订单列表
    public function getOrder(Request $req,$status = 1)
    {
        $info = (object) ['pid'=>4];
        $orders = Order::with(['good'=>function($q){
                    $q->with('good');
                }])->where('status',1)->where('user_id',session('member')->id)->where(function($q) use($status){
                    // 找出订单
                    switch ($status) {
                        // 退货
                        case '5':
                            $q->where('paystatus',1)->where('orderstatus',3);
                            break;
                        // 待评价
                        case '4':
                            $q->whereIn('orderstatus',[2,4,0]);
                            break;
                        // 待收货
                        case '3':
                            $q->where('paystatus',1)->where('orderstatus',1)->where('shipstatus',1)->orWhere('ziti','!=',0);
                            break;
                        // 待发货
                        case '2':
                            $q->where(['paystatus'=>1,'shipstatus'=>0,'ziti'=>0,'orderstatus'=>1]);
                            break;
                        // 待付款
                        default:
                            $q->where(['paystatus'=>0,'orderstatus'=>1]);
                            break;
                    }
                })->orderBy('id','desc')->simplePaginate(10);
                // ->simplePaginate(10)
        $attrs = GoodAttr::get();
        $formats = GoodFormat::where('status',1)->get();
        // 缓存属性们
        $attrs = GoodAttr::get();
        // 如果有购物车
        $goodlists = [];
        // 循环查商品，方便带出属性来
        foreach ($orders as $k => $v) {
            // 如果属性值不为0，查属性值
            foreach ($v->good as $key => $value) {
                if ($value->format_id) {
                    $tmp_format = $formats->where('id',$value['format_id'])->first();
                    if (is_null($tmp_format)) {
                        $tmp_format = '';
                        $tmp_format_name = '';
                    }
                    else
                    {
                        $tmp_format = str_replace('-','.',trim($tmp_format->attr_ids,'-'));
                        $tmp_format_tmp = explode('.',$tmp_format);
                        $tmp_format_name = $attrs->whereIn('id',$tmp_format_tmp)->pluck('value')->toArray();
                        // 添加上单位
                        foreach ($tmp_format_name as $kk => $vv) {
                            $tmp_format_name[$kk] = $vv.$attrs->where('id',$tmp_format_tmp[$kk])->first()->unit;
                        }
                    }
                    $good_format = ['fid'=>$v['format_id'],'format'=>$tmp_format,'format_name'=>implode('-',$tmp_format_name)];
                }
                else
                {
                    $good_format = ['fid'=>0,'format'=>'','format_name'=>''];
                }
                $value->format = $good_format;
            }
        }
        return view($this->theme.'.order',compact('info','orders','status'));
    }
    // 取消订单
    public function getOverOrder($id = '')
    {
        // 如果已经支付，退款到余额里
        DB::transaction(function() use ($id){
            $order = Order::findOrFail($id);
            if ($order->paystatus) {
                User::where('id',$order->user_id)->increment('user_money',$order->total_prices);
            }
            Order::where('id',$id)->update(['orderstatus'=>0]);
        });
        return back()->with('message','订单已取消');
    }
    // 退货申请
    public function getTui($id = '')
    {
        Order::where('id',$id)->update(['orderstatus'=>3]);
        return back()->with('message','退货申请已提交');
    }
    // 订单评价
    public function getComment($oid = '',$gid = '')
    {
        $info = (object) ['pid'=>4];
        $ref = session('homeurl');
        return view($this->theme.'.good_comment',compact('info','gid','oid','ref'));
    }
    public function postComment(GoodCommentRequest $req,$oid = '',$gid = '')
    {
        GoodComment::create(['good_id'=>$gid,'user_id'=>session('member')->id,'title'=>$req->input('data.title'),'content'=>$req->input('data.content'),'score'=>$req->input('data.score')]);
        OrderGood::where('good_id',$gid)->where('order_id',$oid)->update(['commentstatus'=>1]);
        // 评价数+1
        Good::where('id',$gid)->increment('commentnums');
        return redirect($req->ref)->with('message','评价成功！');
    }
    // 订单评价
    public function getShip($oid = '')
    {
        $info = (object) ['pid'=>4];
        Order::where('id',$oid)->update(['orderstatus'=>2]);
        return redirect('/user/order/4')->with('message','收货成功！');
    }
    // 添加购物车
    public function getAddcart(Request $req)
    {
        try {
            // 先清除一天以上的无用购物车
            Cart::where('user_id',0)->where('updated_at','<',Carbon::now()->subday())->delete();
            // 清除完成
            $sid = session()->getId();
            $id = $req->gid;
            $formatid = $req->fid;
            $num = $req->num;
            $userid = !is_null(session('member')) ? session('member')->id : 0;
            $price = $req->gp;
            // 如果用户已经登陆，查以前的购物车
            if ($userid) {
                // 查看是否限时，限购
                $good = Good::findOrFail($id);
                if ($good->isxs && strtotime($good->endtime) < time()) {
                    echo '限时抢购，已经结束！';
                    return;
                }
                // 购物车里有，过往30天订单里有，都算已经购买过
                if ($good->isxl && (Cart::where('good_id',$id)->where('user_id',$userid)->sum('nums') >= $good->xlnums || OrderGood::where('good_id',$id)->where('user_id',$userid)->where('status',1)->where('created_at','>',Carbon::now()->subday(30))->sum('nums') >= $good->xlnums)) {
                    echo '限量购买，已购买过了！';
                    return;
                }
                // 当前用户此次登陆添加的
                $tmp = Cart::where('session_id',$sid)->where('user_id',$userid)->where('good_id',$id)->where('format_id',$formatid)->orderBy('id','desc')->first();
                // 如果没有，看以前有没有添加过这类商品
                if(is_null($tmp))
                {
                    $tmp = Cart::where('user_id',$userid)->where('good_id',$id)->where('format_id',$formatid)->orderBy('id','desc')->first();
                }
            }
            else
            {
                echo "请先登陆！";
                return;
            }
/*            // 如果用户已经登陆，查以前的购物车
            if (session()->has('member')) {
                
            }
            else
            {
                $tmp = Cart::where('session_id',$sid)->where('tuan_id',0)->where('good_id',$id)->where('format_id',$formatid)->orderBy('id','desc')->first();
            }*/
            // 查看有没有在购物车里，有累计数量
            if (!is_null($tmp)) {
                $nums = $num + $tmp->nums;
            }
            else
            {
                $nums = $num;
            }
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
            echo 1;
            return;
        } catch (\Exception $e) {
            echo '添加失败，请稍后再试！';
            // echo $e->getMessage();
            return;
        }
        // 找出所有商品来
        // return back()->with('message','添加购物车成功！');
        // $info = (object) ['pid'=>0];
        // return view($this->theme.'.addcart',compact('info'));
    }
    // 修改数量
    public function postChangecart(Request $req)
    {
        try {
            $id = $req->gid;
            $num = $req->num < 1 ? 1 : $req->num;
            $fid = $req->fid;
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
    public function getCartnums()
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
