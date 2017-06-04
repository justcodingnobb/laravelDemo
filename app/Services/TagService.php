<?php
namespace App\Services;
use App\Models\Ad;
use App\Models\Article;
use App\Models\Cate;
use App\Models\Good;
use App\Models\GoodCate;

class TagService
{
    // 广告
    public function ad($pos_id = 0,$num = 10)
    {
        $ad = Ad::where('pos_id',$pos_id)->where('status',1)->where('del',1)->limit($num)->orderBy('sort','asc')->orderBy('id','desc')->get();
        return $ad;
    }

    // 面包屑导航
    public function goodcatpos($cid)
    {
        try {
            $cate = GoodCate::where('id',$cid)->first();
            if ($cate->parentid == 0) {
                echo "<li class='active'><a href='/shop/goodcate/".$cate->id."'>".$cate->name."</a></li>";
            }
            else
            {
                $parentcate = GoodCate::where('id',$cate->parentid)->first();
                echo "<li><a href='/shop/goodcate/".$parentcate->id."'>".$parentcate->name."</a></li><li class='active'><a href='/shop/goodcate/".$cate->id."'>".$cate->name."</a></li>";
            }
        } catch (\Exception $e) {
            echo '';
        }
    }

    // 取商品列表
    public function good($cid = '',$num = 10,$order = 'id',$desc = 'desc')
    {
        $good = Good::where(function($q)use($cid){
                if($cid != '')
                {
                    $cid = explode(',',$cid);
                    $q->whereIn('cate_id',$cid);
                }
            })->where('status',1)->select('id','title','thumb','price')->limit($num)->orderBy($order,$desc)->get();
        return $good;
    }

    // 取商品分类列表
    public function goodcate($pid = 0,$num = 10)
    {
        $goodcate = GoodCate::where('parentid',$pid)->select('id','name','sort','thumb')->limit($num)->orderBy('sort','asc')->orderBy('id','desc')->get();
        return $goodcate;
    }
    
    /*
    * 取栏目
     */
    public function cate($pid = 0,$nums = 10)
    {
        $cate = Cate::where('parentid',$pid)->limit(4)->orderBy('listorder','asc')->get();
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

    // 面包屑导航
    public function catpos($cid)
    {
        try {
            $cate = Cate::where('id',$cid)->first();
            if ($cate->parentid == 0) {
                echo "<li class='active'><a href='/cate/".$cate->url."'>".$cate->name."</a></li>";
            }
            else
            {
                $parentcate = Cate::where('id',$cate->parentid)->first();
                echo "<li><a href='/cate/".$parentcate->url."'>".$parentcate->name."</a></li><li class='active'><a href='/cate/".$cate->url."'>".$cate->name."</a></li>";
            }
        } catch (\Exception $e) {
            echo '';
        }
    }

}
