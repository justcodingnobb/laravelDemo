<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CateAttr;
use App\Models\Good;
use App\Models\GoodAttr;
use App\Models\GoodComment;
use App\Models\GoodFormat;
use App\Models\GoodSpecItem;
use App\Models\GoodSpecPrice;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Pay;
use App\Models\Tuan;
use App\Models\TuanUser;
use App\Models\Zitidian;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class TuanController extends BaseController
{
    /*
     * 当传了属性时，按属性值计算，没传时按第一个计算
     */
    public function getGood($tid = '',$gid = '')
    {
    	$tuan = Tuan::findOrFail($tid);
        // 查出来商品信息，关联查询出对应属性及属性名称
        $info = Good::with(['goodattr'=>function($q){
                    $q->with('goodattr');
                }])->findOrFail($gid);
        /*
        * 查出来所有的规格信息
        * 1、找出所有的规格ID 
        * 2，查出所有的规格ID对应的名字spec_item及spec内容
        * 3、循环出来所有的规格及规格值
        * */
        $good_spec_ids = GoodSpecPrice::where('good_id',$gid)->pluck('key')->toArray();
        $good_spec_ids = explode('_',implode('_',$good_spec_ids));
        $good_spec = GoodSpecItem::with(['goodspec'=>function($q){
                        $q->select('id','name');
                    }])->whereIn('id',$good_spec_ids)->get();
        $filter_spec = [];
        foreach ($good_spec as $k => $v) {
            $filter_spec[$v->goodspec->name][] = ['item_id'=>$v->id,'item'=>$v->item];
        }
        // 查出第一个规格信息来，标红用的
        $good_spec_price = GoodSpecPrice::where('good_id',$gid)->get()->keyBy('key')->toJson();

        // 取评价，20条
        $goodcomment = GoodComment::with(['user'=>function($q){
                $q->select('id','nickname','thumb','username');
            }])->where('good_id',$gid)->where('del',1)->orderBy('id','desc')->limit(20)->get();
        // 送货地址
        $address = Address::where('user_id',session('member')->id)->where('del',1)->get();
        // 自提点
        $ziti = Zitidian::where('status',1)->where('del',1)->orderBy('sort','asc')->get();
        $info->pid = 0;
        return view($this->theme.'.tuan',compact('info','goodcomment','tuan','ziti','address','good_spec_price','filter_spec'));
    }
    // 添加购物车
    public function getAddorder(Request $req)
    {
        // 查看有没有在购物车里，有累计数量
        DB::beginTransaction();
        try {
            // 清除完成
            $sid = session()->getId();
            $id = $req->gid;
            $tid = $req->tid;
            $spec_key = $req->spec_key;
            $num = $req->num;
            $price = $req->gp;
            $userid = !is_null(session('member')) ? session('member')->id : 0;
            // 先检查是否参加过
            if(!is_null(TuanUser::where('user_id',$userid)->where('t_id',$tid)->first()))
            {
                return back()->with('message','参加过，请不要重复参加！');
                return;
            }
            // 没参过团的
            else
            {
                // 人数加1，库存减1
                Tuan::where('id',$tid)->increment('havnums');
                Tuan::where('id',$tid)->decrement('store');
                TuanUser::create(['user_id'=>$userid,'t_id'=>$tid]);
            }
            $nums = $num;
            $total_prices = $price * $nums;
            $area = Address::where('id',$req->aid)->value('area');
            // 创建订单
            // 原价
            if (!is_null($spec_key)) {
                $old_prices = GoodSpecPrice::where('good_id',$id)->where('key',$spec_key)->value('price');
            }
            else
            {
                $old_prices = Good::where('id',$id)->value('price');
            }
            $order_id = app('com')->orderid();
            $order = ['order_id'=>$order_id,'tuan_id'=>$tid,'user_id'=>$userid,'yhq_id'=>'0','yh_price'=>0,'old_prices'=>$old_prices,'total_prices'=>$total_prices,'create_ip'=>$req->ip(),'address_id'=>$req->aid,'ziti'=>$req->ziti,'area'=>$area];
        
            $order = Order::create($order);
            $spec_key_name = GoodSpecPrice::where('good_id',$id)->where('key',$spec_key)->value('key_name');
            $good_title = Good::where('id',$id)->value('title');
            // 组合order_goods数组
            $order_goods = ['user_id'=>$userid,'order_id'=>$order->id,'good_id'=>$id,'good_title'=>$good_title,'good_spec_key'=>$spec_key,'good_spec_name'=>$spec_key_name,'nums'=>$nums,'price'=>$price,'total_prices'=>$total_prices];
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
}
