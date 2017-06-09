<?php

namespace App\Http\Controllers\Good;

use App\Http\Controllers\Controller;
use App\Http\Requests\Good\CardRequest;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    // 查列表
    public function getIndex(Request $req)
    {
    	$title = '会员卡管理';
        // 搜索关键字
        $starttime = $req->input('starttime');
        $endtime = $req->input('endtime');
        $status = $req->input('status');
		$list = Card::with(['user'=>function($q){
				$q->select('id','nickname','username');
			}])->where(function($q) use($starttime,$endtime){
                if ($starttime != '' && $endtime != '') {
                    $q->where('init_time','>=',$starttime)->where('init_time','<=',$endtime);
                }
            })->where(function($q) use($status){
                if ($status != '') {
                    $q->where('status',$status);
                }
            })->orderBy('id','desc')->paginate(15);
    	return view('admin.card.index',compact('title','list','starttime','endtime','status'));
    }
    // 处理
    public function getAdd()
    {
    	return view('admin.card.add');
    }
    public function postAdd(CardRequest $req,$id = '')
    {
    	$nums = $req->input('data.nums');
    	$prices = $req->input('data.prices');
    	$tmp = [];
    	$date = date('Y-m-d H:i:s');
    	for ($i=0; $i < $nums; $i++) { 
    		$tmp[] = ['card_id'=>app('com')->random(8),'card_pwd'=>app('com')->random(6),'price'=>$prices,'created_at'=>$date,'updated_at'=>$date];
    	}
    	Card::insert($tmp);
    	return back()->with('message','处理成功！');
    }
    // 批量删除
    public function postAlldel(Request $req)
    {
        $ids = $req->input('sids');
        // 是数组更新数据，不是返回
        if(is_array($ids))
        {
            Card::whereIn('id',$ids)->delete();
            return back()->with('message', '批量删除完成！');
        }
        else
        {
            return back()->with('message','请选择商品！');
        }
    }
}
