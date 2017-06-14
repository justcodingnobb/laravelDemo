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
use App\Models\GoodSpecItem;
use App\Models\GoodSpecPrice;
use App\Models\Group;
use App\Models\Manzeng;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Pay;
use App\Models\ReturnGood;
use App\Models\User;
use App\Models\YhqUser;
use App\Models\Youhuiquan;
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
        // 如果当前分类下没有子分类，直接跳转到产品上
        if ($id == $info->arrchildid) {
            return redirect("/shop/goodlist/$id");
        }
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
    // 一级分类直接显示商品页面
    public function getGoodlist(Request $req,$id = 0)
    {   
        // 如果没有标明分类，取第一个
        $info = GoodCate::findOrFail($id);
        $info->pid = 2;
        $sort = isset($req->sort) ? $req->sort : 'sort';
        $sc = isset($req->sc) ? $req->sc : 'asc';
        $list = Good::whereIn('cate_id',explode(',',$info->arrchildid))->where('status',1)->orderBy($sort,$sc)->orderBy('id','desc')->simplePaginate(20);
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
    /*
     * 当传了属性时，按属性值计算，没传时按第一个计算
     */
    public function getGood($id = '')
    {
        // 查出来商品信息，关联查询出对应属性及属性名称
        $info = Good::with(['goodattr'=>function($q){
                    $q->with('goodattr');
                }])->findOrFail($id);
        /*
        * 查出来所有的规格信息
        * 1、找出所有的规格ID 
        * 2，查出所有的规格ID对应的名字spec_item及spec内容
        * 3、循环出来所有的规格及规格值
        * */
        $good_spec_ids = GoodSpecPrice::where('good_id',$id)->pluck('key')->toArray();
        $good_spec_ids = explode('_',implode('_',$good_spec_ids));
        $good_spec = GoodSpecItem::with(['goodspec'=>function($q){
                        $q->select('id','name');
                    }])->whereIn('id',$good_spec_ids)->get();
        $filter_spec = [];
        foreach ($good_spec as $k => $v) {
            $filter_spec[$v->goodspec->name][] = ['item_id'=>$v->id,'item'=>$v->item];
        }
        // 查出第一个规格信息来，标红用的
        $good_spec_price = GoodSpecPrice::where('good_id',$id)->get()->keyBy('key')->toJson();

        // 取评价，20条
        $goodcomment = GoodComment::with(['user'=>function($q){
                $q->select('id','nickname','thumb','username');
            }])->where('good_id',$id)->where('del',1)->orderBy('id','desc')->limit(20)->get();
        $havyhq = Youhuiquan::where('starttime','<',date('Y-m-d H:i:s'))->where('endtime','>',date('Y-m-d H:i:s'))->where('nums','>',0)->where('status',1)->where('del',1)->orderBy('sort','asc')->orderBy('id','desc')->limit(2)->get();
        
        $info->pid = 0;
        $address = [];
        if (session()->has('member')) {
            // 送货地址
            $address = Address::where('user_id',session('member')->id)->where('del',1)->get();
        }
        // 自提点
        $ziti = Zitidian::where('status',1)->where('del',1)->orderBy('sort','asc')->get();
        return view($this->theme.'.good',compact('info','goodcomment','havyhq','good_spec_price','filter_spec','ziti','address'));
    }
    // 直接购买
    public function getFirstOrder(Request $req)
    {
        // 查看有没有在购物车里，有累计数量
        DB::beginTransaction();
        try {
            $sid = session()->getId();
            $id = $req->gid;
            $spec_key = $req->spec_key;
            $num = $req->num;
            $price = $req->gp;
            $userid = !is_null(session('member')) ? session('member')->id : 0;
            $nums = $num;
            $old_prices = $price * $nums;
            // 算折扣
            try {
                $points = session('member')->points;
                $discount = Group::where('points','<=',$points)->orderBy('points','desc')->value('discount');
                if (is_null($discount)) {
                    $discount = Group::orderBy('points','desc')->value('discount');
                }
            } catch (\Exception $e) {
                $discount = 100;
            }
            $prices = ($old_prices * $discount) / 100;
            $area = Address::where('id',$req->aid)->value('area');
            // 创建订单
            $order_id = app('com')->orderid();
            $order = ['order_id'=>$order_id,'user_id'=>$userid,'yhq_id'=>'0','yh_price'=>0,'old_prices'=>$old_prices,'total_prices'=>$prices,'create_ip'=>$req->ip(),'address_id'=>$req->aid,'ziti'=>$req->ziti,'area'=>$area];
        
            $order = Order::create($order);
            $spec_key_name = GoodSpecPrice::where('good_id',$id)->where('key',$spec_key)->value('key_name');
            $good_title = Good::where('id',$id)->value('title');
            // 组合order_goods数组
            $order_goods = ['user_id'=>$userid,'order_id'=>$order->id,'good_id'=>$id,'good_title'=>$good_title,'good_spec_key'=>$spec_key,'good_spec_name'=>$spec_key_name,'nums'=>$nums,'price'=>$price,'total_prices'=>$prices];
            // 插入
            OrderGood::create($order_goods);
            // 没出错，提交事务
            DB::commit();

            $info = (object)['pid'=>3];
            $paylist = Pay::where('status',1)->where('paystatus',1)->orderBy('id','asc')->get();

            return view($this->theme.'.addorder',compact('info','order','paylist'));
        } catch (\Exception $e) {
            // 出错回滚
            DB::rollBack();
            // return back()->with('message','添加失败，请稍后再试！');
            dd($e->getMessage());
        }
    }
    // 购物车
    public function getCart()
    {
        $info = (object) ['pid'=>3];
        // 找出购物车
        $goods = Cart::with(['good'=>function($q){
                    $q->select('id','thumb');
                }])->where(function($q){
                if (!is_null(session('member'))) {
                    $q->where('user_id',session('member')->id);
                }
                else
                {
                    $q->where('session_id',session()->getId());
                }
            })->orderBy('updated_at','desc')->get();
        // 如果购物车为空，显示空模板
        if ($goods->count() == 0) {
            return view($this->theme.'.cart_empty',compact('info'));
        }
        $goodlists = [];
        $total_prices = 0;
        // 如果有购物车
        // 循环查商品，方便带出属性来
        foreach ($goods as $k => $v) {
            $goodlists[$k] = $v;
            $tmp_total_price = number_format($v->nums * $v->price,2,'.','');
            $goodlists[$k]['total_prices'] = $tmp_total_price;
            $total_prices += $tmp_total_price;
        }
        // 找出所有商品来
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
        $ids = $req->input('cid');
        if (count($ids) == 0) {
            return back()->with('message','购物车里是空的，请先购物！');
        }
        // 关掉一天以前的未付款订单
        Order::where('orderstatus',1)->where('created_at','<',Carbon::now()->subday())->update(['orderstatus'=>0]);
        // 所有产品总价
        $old_prices = Cart::whereIn('id',$ids)->sum('total_prices');
        $carts = Cart::whereIn('id',$ids)->orderBy('updated_at','desc')->get();
        $uid = session('member')->id;
        // 创建订单
        $order_id = app('com')->orderid();
        // 查出优惠券优惠多少
        $yh_price = 0;
        // 算折扣
        try {
            $points = session('member')->points;
            $discount = Group::where('points','<=',$points)->orderBy('points','desc')->value('discount');
            if (is_null($discount)) {
                $discount = Group::orderBy('points','desc')->value('discount');
            }
        } catch (\Exception $e) {
            $discount = 100;
        }
        $prices = ($old_prices * $discount) / 100;
        $yhq_id = isset($req->yid) ? $req->yid : 0;
        if ($yhq_id) {
            $yh = YhqUser::where('id',$req->yid)->first();
            $yh_price = $yh->yhq->lessprice;
            $prices = $prices - $yh_price;
        }
        $area = Address::where('id',$req->aid)->value('area');
        $order = ['order_id'=>$order_id,'user_id'=>$uid,'yhq_id'=>$yhq_id,'yh_price'=>$yh_price,'old_prices'=>$old_prices,'total_prices'=>$prices,'create_ip'=>$req->ip(),'address_id'=>$req->aid,'ziti'=>$req->ziti,'area'=>$area,'mark'=>$req->mark];
        // 事务
        DB::beginTransaction();
        try {
            $order = Order::create($order);
            // 组合order_goods数组
            $order_goods = [];
            $clear_ids = [];
            $date = Carbon::now();
            foreach ($carts as $k => $v) {
                $order_goods[$k] = ['user_id'=>$uid,'order_id'=>$order->id,'good_id'=>$v->good_id,'good_title'=>$v->good_title,'good_spec_key'=>$v->good_spec_key,'good_spec_name'=>$v->good_spec_name,'nums'=>$v->nums,'price'=>$v->price,'total_prices'=>$v->total_prices,'created_at'=>$date,'updated_at'=>$date];
                $clear_ids[] = $v->id;
            }
            // 插入
            OrderGood::insert($order_goods);
            // 清空购物车里的这几个产品
            Cart::whereIn('id',$clear_ids)->delete();
            // 没出错，提交事务
            DB::commit();
            $info = (object)['pid'=>3];

            $paylist = Pay::where('status',1)->where('paystatus',1)->orderBy('id','asc')->get();

            return view($this->theme.'.addorder',compact('info','order','paylist'));
        } catch (\Exception $e) {
            // 出错回滚
            DB::rollBack();
            return back()->with('message','添加失败，请稍后再试！');
            // dd($e->getMessage());
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
                        // 待评价
                        case '4':
                            $q->whereIn('orderstatus',[2,0]);
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
    public function getTui($id = '',$gid = '')
    {
        $info = (object) ['pid'=>4];
        return view($this->theme.'.tui',compact('info'));
    }
    public function postTui(Request $req,$id = '',$gid = '')
    {
        // Order::where('id',$id)->update(['orderstatus'=>3]);
        // 先查出来具体的订单商品信息
        $og = OrderGood::where('order_id',$id)->where('good_id',$gid)->first();
        $data = ['user_id'=>$og->user_id,'order_id'=>$og->order_id,'good_id'=>$og->good_id,'good_title'=>$og->good_title,'good_spec_key'=>$og->good_spec_key,'good_spec_name'=>$og->good_spec_name,'nums'=>$og->nums,'price'=>$og->price,'total_prices'=>$og->total_prices,'mark'=>$req->mark];
        OrderGood::where('order_id',$id)->where('good_id',$gid)->update(['status'=>0]);
        ReturnGood::create($data);
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
    // 确认收货
    public function getShip($oid = '')
    {
        $info = (object) ['pid'=>4];
        Order::where('id',$oid)->update(['orderstatus'=>2,'confirm_at'=>date('Y-m-d H:i:s')]);
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
            // 规格key
            $spec_key = $req->spec_key;
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
                $tmp = Cart::where('session_id',$sid)->where('user_id',$userid)->where('good_id',$id)->where('good_spec_key',$spec_key)->orderBy('id','desc')->first();
                // 如果没有，看以前有没有添加过这类商品
                if(is_null($tmp))
                {
                    $tmp = Cart::where('user_id',$userid)->where('good_id',$id)->where('good_spec_key',$spec_key)->orderBy('id','desc')->first();
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
            // 规格信息
            $spec_key_name = GoodSpecPrice::where('good_id',$id)->where('key',$spec_key)->value('key_name');
            $a = ['session_id'=>$sid,'user_id'=>$userid,'good_id'=>$id,'good_title'=>$good->title,'good_spec_key'=>$spec_key,'good_spec_name'=>$spec_key_name,'nums'=>$nums,'price'=>$price,'total_prices'=>$total_prices,'selected'=>1,'type'=>0];
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
            // echo '添加失败，请稍后再试！';
            echo $e->getMessage();
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
            $price = $req->price;
            Cart::where('id',$id)->update(['nums'=>$num,'total_prices'=>$num * $price]);
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
            Cart::where('id',$id)->delete();
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
