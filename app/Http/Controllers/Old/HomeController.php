<?php

namespace App\Http\Controllers\Old;

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
        return view($this->theme.'.home',compact('info'));
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

     public function database()
    {
        /*
        * 插入用户
        $old_user = U::get();
        $new = [];
        foreach ($old_user as $k => $v) {
            $new[] = ['username'=>$v->user_name,'nickname'=>$v->user_name,'openid'=>trim($v->aite_id,'weixin_'),'sex'=>$v->sex,'birthday'=>$v->birthday,'email'=>$v->email,'user_money'=>$v->user_money,'points'=>$v->points,'phone'=>$v->mobile_phone,'thumb'=>$v->heading,'created_at'=>date('Y-m-d H:i:s',$v->reg_time),'updated_at'=>date('Y-m-d H:i:s')];
        }
        User::insert($new);
        */
       /*
       * 栏目
       $old_cate = Category::get();
       $new_cate = [];
       foreach ($old_cate as $k => $v) {
           $new_cate[] = ['id'=>$v->cat_id,'parentid'=>$v->parent_id,'name'=>$v->cat_name,'sort'=>$v->sort_order,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')];
       }
       GoodCate::insert($new_cate);
        */
       /*
       * 商品
       */
       /*$old_goods = G::get();
       $new_goods = [];
       foreach ($old_goods as $k => $v) {
           // $new_goods[] = ['id'=>$v->goods_id,'cate_id'=>$v->cat_id,'title'=>$v->goods_name,'pronums'=>$v->goods_sn,'store'=>$v->goods_number,'price'=>$v->shop_price,'sort'=>$v->sort_order,'content'=>$v->goods_desc,'notice'=>'','pack'=>'','thumb'=>$v->goods_img,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')];
          Good::where('id',$v->goods_id)->update(['thumb'=>$v->original_img]);
          echo $v->goods_id.' - '.$v->original_img."<br />";
       }
       // Good::insert($new_goods);*/

       dd('success');
    }
}
