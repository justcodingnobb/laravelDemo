<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Consume;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getIndex(Request $res)
    {
    	$title = '会员列表';
    	$q = trim($res->input('q',''));
        $list = User::where(function($r)use($q){
        	if ($q != '') {
        		$r->where('username',$q)->orWhere('email',$q)->orWhere('phone',$q)->orWhere('nickname',$q);
        	}
        })->orderBy('id','desc')->paginate(15);
        return view('admin.member.index',compact('list','title'));
    }

    // 审核会员
    public function getStatus($id,$status)
    {
        User::where('id',$id)->update(['status'=>$status]);
        return back()->with('message', '修改会员状态成功！');
    }
    // 修改会员
    public function getEdit($id)
    {
        $title = '修改会员';
        // 拼接返回用的url参数
        $ref = session('backurl');
        $info = User::findOrFail($id);
        return view('admin.member.edit',compact('title','info','ref'));
    }
    public function postEdit(Request $req,$id)
    {
        $pwd = $req->input('data.password');
        $rpwd = $req->input('data.repassword');
        if(strlen($pwd) < 6)
        {
            return back()->with('message', '密码长度小于6位');
        }
        if ($pwd == $rpwd) {
            User::where('id',$id)->update(['password'=>encrypt($rpwd)]);
            return redirect($req->input('ref'))->with('message', '修改会员成功！');
        }
        else
        {
            return back()->with('message', '两次密码不相同，请重新输入');
        }
    }
    // 会员充值
    public function getChong($id = '')
    {
        $title = '会员充值';
        return view('admin.member.chong',compact('title'));
    }
    public function postChong(Request $req,$id = '')
    {
        $pwd = $req->pwd;
        if ($pwd != decrypt(session('user')->password)) {
            return back()->with('message','密码错误');
        }
        $money = $req->input('data.user_money');
        User::where('id',$id)->increment('user_money',$money);
        return back()->with('message', '会员充值成功！');
    }
    // 消费记录
    public function getConsume($id = '')
    {
        $title = '消费记录';
        $list = Consume::where('user_id',$id)->orderBy('id','desc')->paginate(15);
        return view('admin.member.consume',compact('list','title'));
    }
    // 收货地址
    public function getAddress($id = '')
    {
        $title = '收货地址';
        $list = Address::where('user_id',$id)->where('del',1)->orderBy('id','desc')->paginate(15);
        return view('admin.member.address',compact('list','title'));
    }
}
