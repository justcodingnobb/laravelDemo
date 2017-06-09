<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Good;
use App\Models\GoodFormat;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $theme = 'default';
    public function __construct()
    {
        $this->theme = isset(cache('config')['theme']) && cache('config')['theme'] != null ? cache('config')['theme'] : 'default';
    }
    // 更新购物车
	public function updateCart($uid)
    {
        $sid = session()->getId();
        // 找出老数据库购物车里的东西
        $old_carts = Cart::where('user_id',$uid)->select('id','user_id','good_id','format_id','nums','price','total_prices')->get();
        // 把session_id更新过来
        Cart::where('user_id',$uid)->update(['session_id'=>$sid]);
        $old_carts = $old_carts->keyBy('good_id')->toArray();
        // 找出新加入购物车的东西
        $new_carts = Cart::where('session_id',$sid)->select('id','user_id','good_id','format_id','nums','price','total_prices')->get();
        // 先循环来整合现在session_id与数据库的cart
        if ($new_carts->count() > 0) {
            $tmp = [];
            foreach ($new_carts as $k => $v) {
                $gid = $v->good_id;
                // 判断一下现在的session_id里有没有同一款产品
                if (isset($old_carts[$gid]) && $old_carts[$gid]['format_id'] == $v['format_id']) {
                    $nums = $v->nums + $old_carts[$gid]['nums'];
                    $price = $v->price;
                    $v = ['session_id'=>$sid,'user_id'=>$uid,'good_id'=>$gid,'format_id'=>$v['format_id'],'nums'=>$nums,'price'=>$price,'total_prices'=>$nums * $price];
                    // 把旧的删除，新的更新
                    Cart::where('user_id',$uid)->where('good_id',$gid)->where('format_id',$v['format_id'])->delete();
                    Cart::create($v);
                }
                else
                {
                    $v = ['user_id'=>$uid];
                    Cart::where('session_id',$sid)->where('good_id',$gid)->update($v);
                }
            }
        }
    }
    // 更新库存
    public function updateStore($order = '')
    {
        try {
            DB::transaction(function() use($order){
                Order::where('id',$order->id)->update(['paystatus'=>1]);
                User::where('id',$order->user_id)->increment('points',$order->total_prices);
                // 消费记录
                app('com')->consume($order->user_id,$order->id,'-'.$order->total_prices,'支付订单');
                // 减库存，先找出来所有的商品ID与商品属性ID
                $goods = OrderGood::where('order_id',$order->id)->where('status',1)->select('id','good_id','format_id','nums')->get();
                // 循环，判断是直接减商品库存，还是减带属性的库存
                foreach ($goods as $k => $v) {
                    if ($v->format_id == 0) {
                        Good::where('id',$v->good_id)->decrement('store',$v->nums);
                    }
                    else
                    {
                        GoodFormat::where('id',$v->format_id)->decrement('store',$v->nums); 
                    }
                    // 加销量
                    Good::where('id',$v->good_id)->increment('sales',$v->nums);
                }
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
