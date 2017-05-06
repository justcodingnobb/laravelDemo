<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShipRequest;
use App\Models\GoodAttr;
use App\Models\GoodFormat;
use App\Models\Order;
use App\Models\Ship;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $req)
    {
    	$title = '订单列表';
        $q = $req->input('q');
    	$starttime = $req->input('starttime');
        $endtime = $req->input('endtime');
        $status = $req->input('status');
        // 找出订单
        $orders = Order::with(['good'=>function($q){
                    $q->with('good');
                }])->where(function($s) use($q){
	                if ($q != '') {
	                    $s->where('order_id',$q);
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
	            })->orderBy('id','desc')->paginate(10);
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
        return view('admin.order.index',compact('title','orders','q','status','starttime','endtime'));
    }
    // 关闭
    public function getDel($id = '')
    {
    	Order::where('id',$id)->update(['orderstatus'=>0]);
    	return back()->with('message','关闭成功！');
    }
    // 发货
    public function getShip($id = '')
    {
    	$title = '快递单号';
    	$ref = session('backurl');
    	return view('admin.order.ship',compact('title','id','ref'));
    }
    public function postShip(ShipRequest $req,$id = '')
    {
    	$data = $req->input('data');
    	Ship::create($data);
    	// 更新为已经发货
    	Order::where('id',$id)->update(['shipstatus'=>1]);
    	return redirect($req->ref)->with('message','发货成功！');
    }
}
