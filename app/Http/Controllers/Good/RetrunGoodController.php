<?php

namespace App\Http\Controllers\Good;

use App\Http\Controllers\Controller;
use App\Http\Requests\Good\TuiRequest;
use App\Models\ReturnGood;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class RetrunGoodController extends Controller
{
    // 查列表
    public function getIndex(Request $req)
    {
    	$title = '退货管理';
        // 搜索关键字
        $starttime = $req->input('starttime');
        $endtime = $req->input('endtime');
        $status = $req->input('status');
		$list = ReturnGood::with(['good'=>function($q){
				$q->select('id','title');
			},'user'=>function($q){
				$q->select('id','nickname','username');
			}])->where(function($q) use($starttime,$endtime){
                if ($starttime != '' && $endtime != '') {
                    $q->where('starttime','>=',$starttime)->where('starttime','<=',$endtime);
                }
            })->where(function($q) use($status){
                if ($status != '') {
                    $q->where('status',$status);
                }
            })->where('del',1)->orderBy('id','desc')->paginate(15);
    	return view('admin.tui.index',compact('title','list','starttime','endtime','status'));
    }
    // 处理
    public function getStatus($id = '')
    {
    	$title = '处理退货请求';
    	return view('admin.tui.status',compact('title','id'));
    }
    public function postStatus(TuiRequest $req,$id = '')
    {
        // 更新为关闭，退款到余额里
        DB::transaction(function() use ($id,$req){
            ReturnGood::where('id',$id)->update($req->input('data'));
            // 如果同意退货
            if ($req->input('data.status') == 1) {
                $order = ReturnGood::findOrFail($id);
                User::where('id',$order->user_id)->increment('user_money',$order->total_prices);
                // 消费记录
                app('com')->consume($order->user_id,$order->order_id,$order->total_prices,'退货返现',1);
            }
        });
    	return back()->with('message','处理成功！');
    }
}
