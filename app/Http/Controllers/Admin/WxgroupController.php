<?php
/*
 * 微信用户组管理类
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wx\WxApi;
use App\Http\Requests;
use App\Http\Requests\WxconfigRequest;
use App\Models\Wxgroup;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WxgroupController extends Controller
{
	public function __construct()
	{
		$this->wxapi = new WxApi();
	}
	/*
	* 获取所有分组信息
	*/
	public function getIndex()
	{
		$title = '所有分组';
    	$list = Wxgroup::orderBy('id','desc')->paginate(15);
    	return view('admin.wxgroup.index',compact('title','list'));
	}
	/*
	* 同步用户分组
	*/
	public function getUpdate()
	{
		$token = $this->wxapi->token();
		$url = "https://api.weixin.qq.com/cgi-bin/groups/get?access_token=$token";
		// 返回的是json，解码后是对象，要循环成数组输出
		$res = json_decode($this->wxapi->httpGet($url))->groups;
		// 清空组信息
		Wxgroup::where('id','>','0')->delete();
		try {
			$tmp = [];
			foreach ($res as $k => $v) {
				$tmp[] = ['id'=>$v->id,'name'=>$v->name,'count'=>$v->count,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()];
			}
			Wxgroup::insert($tmp);
			return back()->with('message','同步成功！');
		} catch (\Exception $e) {
			return back()->with('message',$e->getMessage());
		}
	}
	/*
	* 创建新的分组
	*/
	public function getAdd()
	{
		$title = '创建分组';
		return view('admin.wxgroup.add',compact('title'));
	}
	public function postAdd(Request $req)
	{
		// 更新微信服务器端
		$token = $this->wxapi->token();
		$url = "https://api.weixin.qq.com/cgi-bin/groups/create?access_token=$token";
		$data = array('group'=>array('name'=>$req->input('data.name')));
		// 注意json中文
		$res = json_decode($this->wxapi->httpGet($url,json_encode($data,JSON_UNESCAPED_UNICODE)));
		if (isset($res->errcode)) {
			return back()->with('message','创建分组失败，'.$res->errcode.'-'.$res->errmsg);
		}
		Wxgroup::create(['id'=>$res->group->id,'name'=>$req->input('data.name')]);
		return redirect('admin/wxgroup/index')->with('message','创建成功！');
	}
	/*
	* 修改用户分组信息
	*/
	public function getEdit($id = '')
	{
		$title = '修改分组';
		$info = Wxgroup::findOrFail($id);
		return view('admin.wxgroup.edit',compact('title','info'));
	}
	public function postEdit(Request $req,$id = '')
	{
		// 更新微信服务器端
		$token = $this->wxapi->token();
		$url = "https://api.weixin.qq.com/cgi-bin/groups/update?access_token=$token";
		$data = array('group'=>array('name'=>$req->input('data.name'),'id'=>$req->input('data.id')));
		// 注意json中文
		$res = json_decode($this->wxapi->httpGet($url,json_encode($data,JSON_UNESCAPED_UNICODE)));
		if ($res->errcode != 0) {
			return back()->with('message','修改分组失败，'.$res->errcode.'-'.$res->errmsg);
		}
		Wxgroup::where('id',$req->input('data.id'))->update(['name'=>$req->input('data.name')]);
		return redirect('admin/wxgroup/index')->with('message','修改成功！');
	}
	/*
	* 删除用户分组
	*/
	public function getDel($id = '')
	{
		$token = $this->wxapi->token();
		$url = "https://api.weixin.qq.com/cgi-bin/groups/delete?access_token=$token";
		// 返回的是json，解码后是对象，要循环成数组输出
		$data = array('group'=>array('id'=>$id));
		$res = json_decode($this->wxapi->httpGet($url,json_encode($data)));
		if ($res->errcode != 0) {
			return back()->with('message','删除分组失败，'.$res->errcode.'-'.$res->errmsg);
		}
		Wxgroup::where('id',$id)->delete();
		return back()->with('message','删除成功！');
	}
}