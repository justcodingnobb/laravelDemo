<?php
namespace App\Services;

use App\Models\GoodCate;

class TagService
{

    /*
    * 文章列表调用功能
     */
    public function lists($catid,$num=10,$order = 'id')
    {
        try {
            $list = Article::whereIn('catid',explode(',', $catid))->select('id','catid','title','thumb','describe','created_at')->orderBy($order,'desc')->limit($num)->get();
        } catch (\Exception $e) {
            $list = '';
        }
        return $list;
    }
     /*
    * 文章列表调用功能
     */
    public function pages($catid,$num=10,$order = 'id')
    {
        try {
            $list = Article::whereIn('catid',explode(',', $catid))->select('id','catid','title','thumb','describe','created_at')->orderBy($order,'desc')->paginate($num);
        } catch (\Exception $e) {
            $list = '';
        }
        return $list;
    }
    // 栏目列表
    public function shopcate($parentid = 0,$num = 20,$order = 'sort')
    {
        try {
            $cate = GoodCate::where('parentid',$parentid)->where('status',1)->select('id','parentid','name')->limit($num)->orderBy($order,'asc')->get();
        } catch (\Exception $e) {
            $cate = '';
        }
        return $cate;
    }
    // 活动列表
    public function special($num = 20,$order = 'sort')
    {
        try {
            $special = Special::where('status',1)->limit($num)->orderBy($order,'asc')->get();
        } catch (\Exception $e) {
            $special = '';
        }
        return $special;
    }
}
