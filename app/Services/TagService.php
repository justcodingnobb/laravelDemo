<?php
namespace App\Services;
use App\Models\Article;
use App\Models\Cate;

class TagService
{

    /*
    * 取栏目
     */
    public function cate($pid = 0)
    {
        $cate = Cate::where('parentid',$pid)->orderBy('listorder','asc')->get();
        return $cate;
    }

    /*
    * 取文章，不带分页
     */
    public function arts($cid = 0,$num = 5)
    {
        $cid = explode(',', $cid);
        $art = Article::whereIn('catid',$cid)->limit($num)->orderBy('id','desc')->get();
        return $art;
    }
}
