<?php

namespace App\Http\Controllers;

use App\Ecs\Category;
use App\Ecs\Good as G;
use App\Ecs\User as U;
use App\Http\Controllers\BaseController;
use App\Models\Article;
use App\Models\Cate;
use App\Models\Good;
use App\Models\GoodCate;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = (object) ['title'=>cache('config')['title'],'keyword'=>cache('config')['keyword'],'describe'=>cache('config')['describe']];
        $info->pid = 0;
        // 找出 新品来
        $news = Good::where('isnew',1)->limit(12)->orderBy('sort','asc')->orderBy('id','desc')->get();
        return view($this->theme.'.home',compact('info','news'));
    }
    // 栏目
    public function getCate($url = '')
    {
        // 找栏目
        $info = Cate::where('url',$url)->first();
        $info->pid = $info->parentid == 0 ? $info->id : $info->parentid;
        // 如果存在栏目，接着找
        if (is_null($info)) {
            return back()->with('message','没有找到对应栏目！');
        }
        $aside_name = $info->name;
        $tpl = $info->theme;
        if ($info->type == 0) {
            $list = Article::whereIn('catid',explode(',', $info->arrchildid))->orderBy('id','desc')->paginate(20);
            return view($this->theme.'.'.$tpl,compact('info','list','aside_name'));
        }
        else
        {
            return view($this->theme.'.'.$tpl,compact('info','aside_name'));
        }
    }
    // 文章
    public function getPost($url = '')
    {
        // 找栏目
        $info = Article::with(['cate'=>function($q){
                $q->select('id','parentid','name');
            }])->where('url',$url)->first();
        $info->pid = $info->cate->parentid == 0 ? $info->catid : $info->cate->parentid;
        $aside_name = $info->cate->name;
        // 如果存在栏目，接着找
        if (is_null($info)) {
            return back()->with('message','没有找到对应栏目！');
        }
        return view($this->theme.'.post',compact('info','aside_name'));
    }
}
