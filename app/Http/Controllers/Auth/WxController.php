<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Models\AuthTmp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use QrCode;
use Socialite;
use Storage;

class WxController extends BaseController
{
    // 二维码登陆
    public function login()
    {
        // 生成文件名
        $dir = public_path('upload/qrcode/');
        $path = $dir.'wxlogin.png';
        $src = '/upload/qrcode/wxlogin.png';
        // 存一个随机id到数据库里，以供后期确定是用户是否登陆，session不可以，全局没办法判断
        $sid = uniqid().str_random(10);
        // 存，过期时间5分钟
        AuthTmp::create(['auth_id'=>$sid,'overtime'=>time() + 300]);
        $ewm = QrCode::format('png')->size(200)->generate(config('app.url').'/oauth/wx?sid='.$sid,$path);
        $info = (object) ['pid'=>0];
        return view('wx.login',compact('info','src','sid'));
        // return $src;
    }
    // 判断是否已经登录，PC版用到的，微信版直接就到了wx方法
    public function islogin(Request $req)
    {
        $sid = $req->sid;
        $openid = AuthTmp::where('auth_id',$sid)->value('openid');
        if ($openid == '0' || is_null($openid)) {
            echo 0;
        }
        else
        {
            // 删除这个临时数据
            AuthTmp::where('auth_id',$sid)->delete();
            // 实现登陆功能
            $user = User::where('status',1)->where('openid',$openid)->first();
            User::where('id',$user->id)->update(['last_ip'=>$req->ip(),'last_time'=>Carbon::now()]);
            session()->put('member',$user);
            // 更新购物车
            $this->updateCart($user->id);
            echo $openid;
        }
    }
    // oauth
    public function wx(Request $req)
    {
        /*$sid = $req->sid;
        // 如果是空的，说明直接登陆的，生成sid
        if (is_null($sid)) {
            // 存一个随机id到数据库里，以供后期确定是用户是否登陆，session不可以，全局没办法判断
            $sid = uniqid().str_random(10);
            // 存，过期时间5分钟
            AuthTmp::create(['auth_id'=>$sid,'overtime'=>time() + 300]);
        }*/
        // snsapi_base,snsapi_userinfo,?sid='.$sid
        return Socialite::driver('wechat')->scopes(['snsapi_userinfo'])->withRedirectUrl(config('app.url').'/oauth/wx/callback')->redirect();
    }

    public function callback(Request $req)
    {
        /*// 先清除5分钟前的临时数据
        AuthTmp::where('overtime','<',time())->delete();
        // 先判断是否已经失效
        $sid = $req->sid;
        if(is_null(AuthTmp::where('auth_id',$sid)->first()))
        {
            return redirect('oauth/wxlogin')->with('message','二维码已失效，请刷新页面重试！');
        }
        // AuthTmp::where('auth_id',$sid)->update(['openid'=>$user->id]);
        */
        // 正常，更新临时数据
        $user = Socialite::driver('wechat')->user();
        // 查有没有openid，没有注册
        if (is_null(User::where('openid',$user->id)->where('status',1)->orderBy('id','asc')->first())) {
            // 如果已经登陆，即为绑定
            if (session()->has('member')) {
                User::where('id',session('member')->id)->update(['openid'=>$user->id]);
            }
            else
            {
                User::create(['openid'=>$user->id,'nickname'=>$user->name]);
            }
        }

        /*else
        {
            User::where('openid',$user->id)->update(['nickname'=>$user->name]);
        }*/
        // 实现登陆功能
        $user = User::where('status',1)->where('openid',$user->id)->orderBy('id','asc')->first();
        User::where('id',$user->id)->update(['last_ip'=>$req->ip(),'last_time'=>Carbon::now()]);
        session()->put('member',$user);
        // 更新购物车
        $this->updateCart($user->id);
        return redirect('/');
    }
}