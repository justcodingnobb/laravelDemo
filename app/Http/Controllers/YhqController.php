<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Cart;
use App\Models\YhqUser;
use App\Models\Youhuiquan;
use DB;
use Illuminate\Http\Request;

class YhqController extends BaseController
{
	// 所有优惠券
    public function getIndex()
    {
    	$info = (object) ['title'=>'发放优惠券','keyword'=>cache('config')['keyword'],'describe'=>cache('config')['describe']];
    	$list = Youhuiquan::where('starttime','<',date('Y-m-d H:i:s'))->where('endtime','>',date('Y-m-d H:i:s'))->where('nums','>',0)->where('status',1)->where('del',1)->orderBy('sort','asc')->orderBy('id','desc')->paginate(10);
    	return view($this->theme.'.yhq',compact('info','list'));
    }
    // 领
    public function getGet($id = '')
    {
    	$info = (object) ['title'=>'领取优惠券成功','keyword'=>cache('config')['keyword'],'describe'=>cache('config')['describe']];
    	// 先查是不是已经领过
    	if (!is_null(YhqUser::where('user_id',session('member')->id)->where('yhq_id',$id)->first())) {
    		return back()->with('message','领取过，请不要重复领取！');
    	}
    	// 查出优惠券到期时间
    	$endtime = Youhuiquan::where('id',$id)->value('endtime');
    	$data = ['user_id'=>session('member')->id,'yhq_id'=>$id,'endtime'=>$endtime];
    	DB::beginTransaction();
    	try {
    		// 优惠券数量减1，添加给用户
    		YhqUser::create($data);
    		Youhuiquan::where('id',$id)->decrement('nums');
    		// 没出错，提交事务
            DB::commit();
    	} catch (\Exception $e) {
    		// 出错回滚
            DB::rollBack();
            return back()->with('message','领取失败，请稍后再试！');
    	}
    	return view($this->theme.'.lyhq',compact('info'));
    }
    // 我的优惠券
    public function getList()
    {
    	$info = (object) ['title'=>'我的优惠券','keyword'=>cache('config')['keyword'],'describe'=>cache('config')['describe']];
    	$list = YhqUser::with('yhq')->where('del',1)->orderBy('id','desc')->paginate(10);
    	return view($this->theme.'.myyhq',compact('info','list'));
    }
    // 删除优惠券
    public function getDel($id = '')
    {
    	DB::beginTransaction();
    	try {
    		$yhq = YhqUser::findOrFail($id);
    		// 优惠券如果没过期并且没使用，数量加1
    		if($yhq->endtime > date('Y-m-d H:i:s') && $yhq->status)
    		{
    			Youhuiquan::where('id',$yhq->yhq_id)->increment('nums');
    		}
    		YhqUser::where('id',$id)->update(['del'=>0]);
    		// 没出错，提交事务
            DB::commit();
            return back()->with('message','删除成功！');
    	} catch (\Exception $e) {
    		// 出错回滚
            DB::rollBack();
            return back()->with('message','领取失败，请稍后再试！');
    	}
    }
    // 比价
    public function getPrice($id = '')
    {
        // 当前优惠券价
        $price = YhqUser::with('yhq')->where('id',$id)->first();
        // 购物车总价
        $total_prices = Cart::where('user_id',session('member')->id)->sum('total_prices');
        if ($price->yhq->price < $total_prices) {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
}
