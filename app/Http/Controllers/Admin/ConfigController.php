<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Cache;

class ConfigController extends Controller
{
    public function index(Request $req)
    {
    	$title = '系统配置';
    	$config = Config::findOrFail(1);
    	return view('admin.config.index',compact('title','config'));
    }
    public function postIndex(Request $req)
    {
    	$data = $req->input('data');
    	Config::where('id',1)->update($data);
    	// 更新缓存
    	Cache::forever('config',$data);
    	return back()->with('message','更新成功');
    }
}
