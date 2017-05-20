<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Requests\User\AddressRequest;
use App\Models\Address;
use App\Models\User;
use Carbon\Carbon;
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
        $ref = url()->previous();
        $info = (object) [];
        $info->pid = 0;
        return view('user.login',compact('ref','info'));
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
            User::where('id',$user->id)->update(['last_ip'=>$res->ip(),'last_time'=>Carbon::now()]);
	    	session()->put('member',$user);
            // 更新购物车
            // $this->updateCart($user->id);
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
        $ref = url()->previous();
        $info = (object) [];
        $info->pid = 0;
        return view('user.register',compact('ref','info'));
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
	    	$user = User::create(['username'=>$username,'password'=>$pwd,'email'=>$email,'last_ip'=>$res->ip(),'last_time'=>Carbon::now()]);
	    	session()->put('member',$user);
            // 更新购物车
            // $this->updateCart($user->id);
	    	return redirect($res->ref);
    	} catch (\Exception $e) {
    		return back()->with('message','注册失败，请稍候再试！');
    	}
    }
    // 退出登陆
    public function getLogout(Request $res)
    {
    	session()->pull('member');
        // 重新生成session_id
        session()->regenerate();
    	return back()->with('message','您已退出登陆！');
    }
    // 会员中心
    public function getCenter(Request $req)
    {
    	// 取个人信息
    	$info = User::findOrFail(session('member')->id);
        $info->pid = 0;
    	return view('user.usercenter',compact('info'));
    }

    // 收货地址
    public function getAddress()
    {
        $list = Address::where('user_id',session('member')->id)->where('del',1)->get();
        return view('user.address',compact('list'));
    }
    // 添加地址
    public function getAddressAdd()
    {
        return view('user.address_add');
    }
    public function postAddressAdd(AddressRequest $req)
    {
        $data = $req->input('data');
        $data['user_id'] = session('member')->id;
        Address::create($data);
        return redirect('user/address')->with('message','添加成功');
    }
    // 修改地址
    public function getAddressEdit($id = '')
    {
        $info = Address::findOrFail($id);
        return view('user.address_edit',compact('info'));
    }
    public function postAddressEdit(AddressRequest $req,$id = '')
    {
        $data = $req->input('data');
        Address::where('id',$id)->update($data);
        return redirect('user/address')->with('message','修改成功');
    }
    // 修改地址
    public function getAddressDel($id = '')
    {
        Address::where('id',$id)->update(['del'=>0]);
        return back()->with('message','删除成功');
    }
}
