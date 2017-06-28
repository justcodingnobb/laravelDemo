<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\ShipRequest;
use App\Models\Address;
use App\Models\GoodAttr;
use App\Models\GoodFormat;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Ship;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function index(Request $req)
    {
    	$title = '订单列表';
        $q = $req->input('q');
        $key = $req->input('key');
    	$starttime = $req->input('starttime');
        $endtime = $req->input('endtime');
        $status = $req->input('status');
        $shipstatus = $req->input('shipstatus');
        $paystatus = $req->input('paystatus');
        $ziti = $req->input('ziti');
        // 找出订单
        $orders = Order::with(['good'=>function($q){
                    $q->select('id','user_id','order_id','good_id','good_title','good_spec_key','good_spec_name','nums','price','total_prices');
                },'address','zitidian'])->where(function($r) use($q){
                    if ($q != '') {
                        // 查出来收货人ID
                        $uid = Address::where('people','like',"%$q%")->orWhere('phone','like',"%$q%")->pluck('id')->toArray();
                        $r->whereIn('address_id',$uid);
                    }
                })->where(function($r) use($key){
                    if ($key != '') {
                        // 查出来订单ID
                        $oids = OrderGood::where('good_title','like',"%$key%")->pluck('order_id')->toArray();
                        $r->whereIn('id',$oids)->orWhere('order_id','like',"%$key%");
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
	                    $q->where('orderstatus',$status);
	                }
	            })->where(function($q) use($shipstatus){
                    if ($shipstatus != '') {
                        $q->where('shipstatus',$shipstatus);
                    }
                })->where(function($q) use($paystatus){
                    if ($paystatus != '') {
                        $q->where('paystatus',$paystatus);
                    }
                })->where(function($q) use($ziti){
                    if ($ziti != 0 && $ziti != '') {
                        $q->where('ziti','!=',0);
                    }
                    elseif($ziti == 0 && $ziti != '')
                    {
                        $q->where('ziti',0);
                    }
                })->where('status',1)->orderBy('id','desc')->paginate(10);
        return view('admin.order.index',compact('title','orders','q','status','starttime','endtime','ziti','paystatus','shipstatus','key'));
    }
    // 批量发货
    public function postAllShip(Request $req)
    {
        $sids = $req->sids;
        // 找出这里边所有已经付款的
        $sids = Order::whereIn('id',$sids)->where('paystatus',1)->pluck('id');
        Order::whereIn('id',$sids)->update(['shipstatus'=>1,'ship_at'=>date('Y-m-d H:i:s')]);
        return back()->with('message','发货成功！');
    }
    // 批量自提
    public function postAllZiti(Request $req)
    {
        $sids = $req->sids;
        $sids = Order::whereIn('id',$sids)->where('paystatus',1)->pluck('id');
        Order::whereIn('id',$sids)->update(['orderstatus'=>2]);
        return back()->with('message','设置自提成功！');
    }
    // 批量关闭
    public function postAllDel(Request $req)
    {
        $sids = $req->sids;
        Order::whereIn('id',$sids)->update(['orderstatus'=>0]);
        return back()->with('message','关闭成功！');
    }
    // 关闭
    public function getDel($id = '')
    {
    	Order::where('id',$id)->update(['orderstatus'=>0]);
    	return back()->with('message','关闭成功！');
    }
    // 自提、完成
    public function getZiti($id = '')
    {
        Order::where('id',$id)->update(['orderstatus'=>2]);
        return back()->with('message','自提成功！');
    }
    // 发货
    public function getShip($id = '')
    {
    	$title = '快递单号';
    	return view('admin.order.ship',compact('title','id'));
    }
    public function postShip(Request $req,$id = '')
    {
    	// 更新为已经发货
        if (Order::where('id',$id)->value('paystatus') == 1) {
        	Order::where('id',$id)->update(['shipstatus'=>1,'shopmark'=>$req->input('data.shopmark'),'ship_at'=>date('Y-m-d H:i:s')]);
            return $this->ajaxReturn(1,'发货成功！');
        }
        return $this->ajaxReturn(0,'还未付款！');
    }
    /*// 退货
    public function getTui($id = '')
    {
        // 更新为关闭，退款到余额里
        DB::transaction(function() use ($id){
            $order = Order::findOrFail($id);
            if ($order->paystatus) {
                User::where('id',$order->user_id)->increment('user_money',$order->total_prices);
            }
            Order::where('id',$id)->update(['orderstatus'=>0]);
        });
        return back()->with('message','退货成功！');
    } */
}
