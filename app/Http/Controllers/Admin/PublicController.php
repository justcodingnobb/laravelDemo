<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Priv;
use App\Models\RoleUser;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $guard = 'admin';
    protected $username = 'name';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['getLogout','getLogin','postLogin']]);
    }
    public function getLogin()
    {
        if(\Session::has('user')){return redirect('/admin/index/index');}
        return view('admin.login');
    }
    /**
     * 登陆提交数据验证功能，成功后跳转到后台首页
     * @param  Request $request [description]
     */
    public function postLogin(Request $request)
    {
        if (Auth::guard('admin')->check() || Auth::guard('admin')->attempt(['name'=>$request->name,'password'=>$request->password]))
        {
            $user = Auth::guard('admin')->user();
            if ($user->status != 1) {
                return back()->with('message','用户名被禁用！'); 
            }
            // 查出所有用户权限并存储下来
            $allRole = RoleUser::where('user_id',$user->id)->pluck('role_id')->toArray();
            $user->allRole = $allRole;
            $allPriv = Priv::whereIn('role_id',$allRole)->pluck('label');
            $user->allPriv = $allPriv->unique()->toArray();
            \Session::put('user',$user);
            return redirect('/admin/index/index');
        }
        else
        {
            return back()->with('message','用户名或者密码错误');
        }
    }
    /**
     * 自写logout，实现登出后的跳转页面控制
     */
    public function getLogout()
    {
        if(is_null(Auth::guard('admin')->logout())){
            \Session::put('user',null);
            return redirect('/admin/login');
        }
    }
}
