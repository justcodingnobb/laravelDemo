<?php
/*
 * 微信用户组管理类
*/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wx\WxApi;
use App\Http\Requests;
use App\Http\Requests\WxconfigRequest;
use App\Models\Wxuser;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WxuserController extends Controller
{
	public function __construct()
	{
		$this->wxapi = new WxApi();
	}
	// 微信用户列表
	public function getIndex()
	{
		$title = '所有分组';
    	$list = Wxuser::with('group')->orderBy('id','desc')->paginate(15);
    	return view('admin.wxuser.index',compact('title','list'));
	}
	// 获取微信端用户列表
	public function getUpdate()
	{
		// 取所有openid
		$resopenid = $this->getlist();
		// 指拉取用户信息
		$gettoken = $this->wxapi->token();
		$urls = "https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=$gettoken";
		$alldata = array();
		// 关注者多于100时，循环出所有人信息，微信规定每次拉取不得多于100人
		if (count($resopenid) > 100) {
			// 每100个请求一次用户数据
			for($i = 0; $i <= count($resopenid) - 100; $i += 100)
			{
				$alldata = $this->getuserinfo($urls,$resopenid,$alldata,$i);
			}
		}
		else
		{
			$alldata = $this->getuserinfo($urls,$resopenid,$alldata,$i = count($resopenid),$isfor = 0);
		}
		// 先清空数据库，然后将所有取得的数据放入数据库中
		Wxuser::where('id','>',0)->delete();
		Wxuser::insert($alldata);
		return back()->with('message','同步成功');
	}
	/*
	* 设置用户备注信息
	*/
	public function getRemark($id = '')
	{
		$title = '设置备注';
    	$info = Wxuser::findOrFail($id);
    	return view('admin.wxuser.remark',compact('title','info'));
	}
	public function postRemark(Request $req)
	{
		// 更新微信端数据
		$wxdata = json_encode(array('openid'=>$req->input('data.openid'),'remark'=>$req->input('data.remark')),JSON_UNESCAPED_UNICODE);
		$token = $this->wxapi->token();
		$url = "https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=$token";
		$res = json_decode($this->wxapi->httpGet($url,$wxdata),true);
		if ($res['errcode'] != 0) {
			return back()->with('message','设置微信备注失败，'.$res['errcode'].'-'.$res['errmsg']);
		}
		// 更新本地数据
		Wxuser::where('openid',$req->input('data.openid'))->update(['remark'=>$req->input('data.remark')]);
		return back()->with('message','设置微信备注成功！');
	}
	/*
	* 批量移动用户分组
	*/
	public function getTogroup()
	{
		// 判断
		if(I('post.groupid') == null) {$this->error('请选择分组');}
		// 查出openid
		$map['userid'] = array('in',arr2str(I('post.uids')));
		$opids = M('Wxuser')->where($map)->getField('openid',true);
		// 更新微信端
		$data = json_encode(array('openid_list'=>$opids,'to_groupid'=>I('post.groupid')));
		$token = $this->wxapi->gettoken();
		$url = "https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate?access_token=$token";
		$res = string2array($this->wxapi->httpGet($url,$data));
		if ($res['errcode'] != 0){$this->error('移动用户失败，'.$res['errcode'].'-'.$res['errmsg']);}
		// 更新本地
		if (M('Wxuser')->where($map)->save(array('groupid'=>I('post.groupid'))))
		{
			// 记录用户行为
    		$this->addlog('userid='.arr2str(I('post.uids')));
			$this->error('移动用户成功',U('index'));
		}
		else
		{
			$this->error('移动用户失败');
		}
	}
	/*
	* 批量拉取用户信息方法
	*/
	private function getuserinfo($urls,$resopenid,$alldata,$i = 0,$isfor = 1)
	{
		$data = array();
		// 100个openid
		if($isfor == 0)
		{
			for($j = 0; $j < $i; $j++)
			{
				$data[] = array('openid'=>$resopenid[$j],'lang'=>"zh-CN");
			}
		}
		else
		{
			for($j = $i; $j < $i + 100; $j++)
			{
				$data[] = array('openid'=>$resopenid[$i],'lang'=>"zh-CN");
			}
		}
		$data = json_encode(array('user_list'=>$data));
		$alldata = array_merge(json_decode($this->wxapi->httpGet($urls,$data),true)['user_info_list'],$alldata);
		foreach ($alldata as $k => $v) {
			$v['group_id'] = $v['groupid'];
			unset($v['groupid']);
			unset($v['tagid_list']);
			$v['created_at'] = $v['updated_at'] = Carbon::now();
			$alldata[$k] = $v;
		}
		return $alldata;
	}
	// 获取所有 openid方法
	private function getlist($next = '',$datas = array())
	{
		$token = $this->wxapi->token();
		$url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token&next_openid=$next";
		$res = json_decode($this->wxapi->httpGet($url),true);
		$datas = array_merge($res['data']['openid'],$datas);
		// 当拉取到的数据大于10000时，循环拉取所有
		if ($res['count'] >= 10000) {
			$this->getlist($res['next_openid'],$datas);
		}
		return $datas;
	}
}