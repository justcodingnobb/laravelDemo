<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends BaseController
{
	// 登陆
	public function getLogin()
	{
		if(!is_null(session('member')))
		{
			// 如果上次的页面是登陆页面，回首页
			if (strpos(url()->previous(),'/user/login')) {
				return redirect('/')->with('message','您已登陆！');
			}
			else
			{
				return redirect(url()->previous())->with('message','您已登陆！');
			}
		}
        $goodcateid = 0;
        $pcatid = 100;
        $ref = url()->previous();
        $seo = ['title'=>'登陆会员中心','keyword'=>config('shop.keyword'),'description'=>config('shop.description')];
        return view(config('shop.pc').'login',compact('seo','goodcateid','pcatid','ref'));
	}
	// 登陆
    public function postLogin(UserRequest $res)
    {
    	if(!is_null(session('member')))
		{
			return redirect(url()->previous())->with('message','您已登陆！');
		}
    	$username = $res->input('data.username');
    	$pwd = $res->input('data.password');
	    $user = User::where('status',1)->where('username',$username)->first();
	    if (is_null($user)) {
	    	return back()->with('message','用户不存在或已被禁用！');
	    }
	    else
	    {
		    if ($pwd != decrypt($user->password)) {
		    	return back()->with('message','密码不正确！');
		    }
	    	session()->put('member',$user);
	    	// 更新购物车
	    	$this->updateCart($user->id);
	    	return redirect($res->ref);
	    }
    }
    // 注册
	public function getRegister()
	{
		if(!is_null(session('member')))
		{
			// 如果上次的页面是登陆页面，回首页
			if (strpos(url()->previous(),'/user/register')) {
				return redirect('/')->with('message','您已登陆！');
			}
			else
			{
				return redirect(url()->previous())->with('message','您已登陆！');
			}
		}
        $goodcateid = 0;
        $pcatid = 100;
        $ref = url()->previous();
        $seo = ['title'=>'注册会员','keyword'=>config('shop.keyword'),'description'=>config('shop.description')];
        return view(config('shop.pc').'register',compact('seo','goodcateid','pcatid','ref'));
	}
	// 注册
    public function postRegister(UserRequest $res)
    {
    	if(!is_null(session('member')))
		{
			return redirect(url()->previous())->with('message','您已登陆！');
		}
    	$username = trim($res->input('data.username'));
    	// 查一样有没有重复的用户名
    	$ishav = User::where('username',$username)->first();
    	if (!is_null($ishav)) {
    		return back()->with('message','用户名已经被使用，请换一个再试！');
    	}
    	$pwd = encrypt($res->input('data.passwords'));
    	$email = $res->input('data.email');
    	try {
	    	$user = User::create(['username'=>$username,'password'=>$pwd,'email'=>$email]);
	    	session()->put('member',$user);
	    	// 找出购物车里的东西，加入到数据库里
	    	$this->updateCart($user->id);
	    	return redirect($res->ref);
    	} catch (\Exception $e) {
    		return back()->with('message','注册失败，请稍候再试！');
    	}
    }
    // 退出登陆
    public function getLogout(Request $res)
    {
    	// 退出时清空购物车，另外应设置定时任务，清空一天前的购物车
    	// Cart::where('session_id',session()->getId())->where('user_id',0)->delete();
    	session()->pull('member');
    	// 重新生成session_id
    	session()->regenerate();
    	return back()->with('message','您已退出登陆！');
    }
    // 会员中心
    public function usercenter(Request $req)
    {
    	$goodcateid = 0;
    	$pcatid = 100;
    	$seo = ['title'=>'会员中心','keyword'=>config('shop.keyword'),'description'=>config('shop.description')];
    	// 取个人信息
    	$info = User::findOrFail(session('member')->id);
    	return view(config('shop.pc').'usercenter',compact('seo','goodcateid','pcatid','info'));
    }
    // 订单记录
    public function orderlist(Request $req)
    {
    	$goodcateid = 0;
    	$pcatid = 100;
    	$seo = ['title'=>'订单记录','keyword'=>config('shop.keyword'),'description'=>config('shop.description')];
    	// 取个人信息
    	$list = Order::with(['good'=>function($q){
    		$q->with(['good'=>function($g) {
    			$g->select('id','title','thumb');
    		}]);
    	}])->where('user_id',session('member')->id)->where('status',1)->paginate();
    	return view(config('shop.pc').'orderlist',compact('seo','goodcateid','pcatid','list'));
    }
}
