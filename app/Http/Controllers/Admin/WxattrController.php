<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wx\WxApi;
use App\Http\Requests\WxattrRequest;
use App\Models\Wxattr;
use Illuminate\Http\Request;
use Storage;

class WxattrController extends Controller
{
    // 素材列表
    public function getIndex()
    {
        $title = '素材列表';
        $list = Wxattr::orderBy('id','desc')->paginate(15);
        return view('admin.wxattr.index',compact('title','list'));
    }

    // 添加素材
    public function getAdd()
    {
        $title = '添加素材';
        return view('admin.wxattr.add',compact('title'));
    }
    public function postAdd(WxattrRequest $req)
    {
        $data = $req->data;
        if ($data['type'] == 'image' || $data['type'] == 'voice' || $data['type'] == 'thumb') {
            $res = $this->uploadimg($req);
        }
        if ($data['type'] == 'video') {
            $res = $this->uploadvideo($req);
        }
        if ($res == 1) {
            return redirect('/admin/wxattr/index')->with('message','添加素材成功！');
        }
        else
        {
            return back()->with('message',$res);
        }
    }
    // 删除
    public function getDel($id = '')
    {
        try {
            $wxattr = Wxattr::findOrFail($id);
            // 微信端删除操作
            $wxapi = new WxApi();
            $access_token = $wxapi->token();
            $filedata = array('media_id'=>$wxattr->media_id);
            $url = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=$access_token";
            $result = $wxapi->httpGet($url,json_encode($filedata));
            $result = json_decode($result,true);
            if ($result['errcode'] != 0) {
                return back()->with('message','删除素材失败，'.$result['errcode'].$result['errmsg']);
            }
            // 本地文件删除
            $filepath = rtrim(public_path(),'/').$wxattr->localurl;
            if (file_exists($filepath)){unlink($filepath);}
            Wxattr::delete($id);
            return back()->with('message','删除素材成功！');
        } catch (\Exception $e) {
            return back()->with('message','没有找到素材！'.$e->getMessage());
        }
    }
    // 数量
    public function getNums()
    {
    	$title = '微信素材总数';
        $wxapi = new WxApi();
        // 查询微信端素材各类型总数
        $access_token = $wxapi->token();
        $url = "https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=$access_token";
        $nums = $wxapi->httpGet($url);
        $nums = json_decode($nums,true);
        /*// 取微信端素材列表
        $data = array('type'=>'image','offset'=>0,'count'=>20);
        $urls = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=$access_token";
        $results = $this->wxapi->httpGet($urls,json_encode($data));
        $results = json_decode($results,true);
        var_dump($results);*/
        return view('admin.wxattr.nums',compact('title','nums'));
    }
    /*
    * 上传永久素材，图片，大小1M，格式jpg/png，数量5000张
    */
    public function uploadimg($req){
        $wxapi = new WxApi();
        $access_token = $wxapi->token();
        $data = $req->input('data');
        $filepath = rtrim(public_path(),'/').$data['image'];
        $filedata = array('media'=>$filepath);
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$access_token&type=".$data['type'];
        $result = $wxapi->httpGet($url,$filedata);
        $result = json_decode($result,true);
        if (!isset($result['errcode'])) {
            // 存入本地数据库
            $cd['type'] = $data['type'];
            $cd['localurl'] = $data['image'];
            $cd['media_id'] = $result['media_id'];
            $cd['url'] = $result['url'];
            Wxattr::create($cd);
            return 1;
        }else{
            return $result['errcode'];
        }
    }
    /*
    * 上传永久素材，视频，大小10M，格式MP4,1000个
    */
    public function uploadvideo($req){
        $wxapi = new WxApi();
        $access_token = $wxapi->token();
        $data = $req->input('data');
        $filepath = rtrim(public_path(),'/').$data['image'];
        $description = '{
                            "title":"'.$data['title'].'",
                            "introduction":"'.$data['introduction'].'"
                        }';
        $filedata = array('media'=>$filepath,'description'=>$description);
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$access_token&type=".$data['type'];
        $result = $wxapi->httpGet($url,$filedata);
        $result = json_decode($result,true);
        if (!isset($result['errcode'])) {
            // 存入本地数据库
            $cd['type'] = $data['type'];
            $cd['localurl'] = $data['image'];
            $cd['media_id'] = $result['media_id'];
            $cd['url'] = $result['url'];
            Wxattr::create($cd);
            return 1;
        }else{
            return $result['errcode'];
        }
    }
    /**
     * 文件上传
     * @param  Request $res [取文件用，资源]
     */
    public function postUploadimg(Request $res)
    {
        $allSize = 100;
        $ext = array('jpg','jpeg','gif','png','doc','docx','xls','xlsx','ppt','pptx','pdf','txt','rar','zip','swf','apk','mp4');
        $isAllow = collect($ext);
        /* 返回JSON数据 */
        $return['error'] = 1;
        // 验证是否有要上传的文件
        if(!$res->hasFile('imgFile')){
            $return['message'] = '文件不存在！';
            return json_encode($return);
        }
        // 取得文件后缀
        $ext = $res->file('imgFile')->getClientOriginalExtension();
        // 检查文件类型
        if(!$isAllow->contains(strtolower($ext)))
        {
            $return['message']  = '文件类型错误!';
            return json_encode($return);
        }
        // 检查文件大小，不得大于3M
        $size = $res->file('imgFile')->getClientSize();
        if($size > $allSize*1073741824)
        {
            $return['message']   = '单个文件大于'.$allSize.'M!';
            return json_encode($return);
        }
        // 生成文件名
        $filename = date('Ymdhis').rand(100, 999);
        // 移动到新的位置，先创建目录及更新文件名为时间点
        $dir = public_path('upload/wxattrs/'.date('Ymd').'/');
        if(!is_dir($dir)){
            Storage::makeDirectory(date('Ymd'));
        }
        $isTrue = $res->file('imgFile')->move($dir, $filename.'.'.$ext);
        $localurl = '/wxattrs/'.date('Ymd').'/'.$filename.'.'.$ext;
        $url = '/upload'.$localurl;
        if($isTrue){
            $return['error'] = 0;
            $return['url'] = $url;
        }
        return json_encode($return);
    }
}
