<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Config;
use App\Models\Good;
use App\Models\GoodAttr;
use App\Models\GoodFormat;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Priv;
use Cache;
use Excel;

class IndexController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 主页里关闭调试
        \Debugbar::disable();
        $this->menu = new Menu;
    }

    /**
     * 后台首页
     */
    public function getIndex()
    {
        $allUrl = $this->allPriv();
        $main = $this->menu->where('parentid','=','0')->where('display','=','1')->orderBy('listorder','asc')->get()->toArray();
        if (in_array(1, session('user')->allRole))
        {
            $mainmenu = $main;
        }
        else
        {
            $mainmenu = array();
            foreach ($main as $k => $v) {
                foreach ($allUrl as $url) {
                    if ($v['url'] == $url) {
                        $mainmenu[$k] = $v;
                    }
                }
            }
        }
        return view('admin.index',compact('mainmenu'));
    }
    /**
     * 主要信息展示
     */
    public function getMain()
    {
        $title = '系统信息';
        $data = [];
        // 今日总订单量
        $data['today_ordernum'] = Order::where('orderstatus','>',0)->where('created_at','>',date('Y-m-d 00:00:00'))->count();
        // 今日销售额
        $data['today_prices'] = Order::where('orderstatus','>',0)->where('created_at','>',date('Y-m-d 00:00:00'))->sum('total_prices');
        // 今日已收款数
        $data['today_prices_real'] = Order::whereIn('orderstatus',[1,2])->where('created_at','>',date('Y-m-d 00:00:00'))->where('paystatus',1)->sum('total_prices');
        // 今日未收款数
        $data['today_prices_no'] = $data['today_prices'] - $data['today_prices_real'];
        // 今日待发货
        $data['today_ship'] = Order::where('orderstatus',1)->where('shipstatus',0)->where('ziti',0)->where('created_at','>',date('Y-m-d 00:00:00'))->where('paystatus',1)->count();
        // 今日销售统计表，先查出今天的已付款订单，再按订单查出所有产品及属性
        // ->where('created_at','>',date('Y-m-d 00:00:00'))
        $order_ids = Order::where('orderstatus',1)->where('paystatus',1)->pluck('id');
        $goods = OrderGood::whereIn('order_id',$order_ids)->get();
        // 循环出来每一个产品的重量值，并去重累加
        $good_ship = [];
        foreach ($goods as $k => $v) {
            if (isset($good_ship[$v->good_id.'_'.$v->format_id])) {
                $good_ship[$v->good_id.'_'.$v->format_id]['nums'] += $v->nums;
            }
            else
            {
                $good_ship[$v->good_id.'_'.$v->format_id] = ['good_id'=>$v->good_id,'nums'=>$v->nums,'format'=>$v->format_id];
            }
        }
        // 查每个的重量并累加，先查出所有商品属性及商品规格，省去重复查询
        $formats = GoodFormat::whereIn('good_id',$goods->pluck('good_id'))->get();
        $attrs = GoodAttr::where('status',1)->get();
        foreach ($good_ship as $k => $v) {
            $tmp_good = Good::select('id','title','pronums','price','weight')->findOrFail($v['good_id'])->toArray();
            if ($v['format']) {
                $tmp_format = $formats->where('id',$v['format'])->first()->attr_ids;
                // 查第一个的值
                $tmp_format = explode('-', trim($tmp_format,'-'))[0];
                $tmp_weight = $attrs->where('id',$tmp_format)->first()->value;
                $tmp_good['weight'] = (float) $tmp_weight;
                $tmp_good['total_weight'] = $v['nums'] * (float) $tmp_weight;
            }
            else
            {
                $tmp_good['total_weight'] = $v['nums'] * $tmp_good['weight'];
            }
            unset($v['good_id']);
            $good_ship[$k] = array_merge($tmp_good,$v);
        }
        return view('admin.index.main',compact('title','data','good_ship'));
    }
    public function getExcel()
    {
        // 今日销售统计表，先查出今天的已付款订单，再按订单查出所有产品及属性
        // ->where('created_at','>',date('Y-m-d 00:00:00'))
        $order_ids = Order::where('orderstatus',1)->where('paystatus',1)->pluck('id');
        $goods = OrderGood::whereIn('order_id',$order_ids)->get();
        // 循环出来每一个产品的重量值，并去重累加
        $good_ship = [];
        foreach ($goods as $k => $v) {
            if (isset($good_ship[$v->good_id.'_'.$v->format_id])) {
                $good_ship[$v->good_id.'_'.$v->format_id]['nums'] += $v->nums;
            }
            else
            {
                $good_ship[$v->good_id.'_'.$v->format_id] = ['good_id'=>$v->good_id,'nums'=>$v->nums,'format'=>$v->format_id];
            }
        }
        // 查每个的重量并累加，先查出所有商品属性及商品规格，省去重复查询
        $formats = GoodFormat::whereIn('good_id',$goods->pluck('good_id'))->get();
        $attrs = GoodAttr::where('status',1)->get();
        foreach ($good_ship as $k => $v) {
            $tmp_good = Good::select('id','title','pronums','price','weight')->findOrFail($v['good_id'])->toArray();
            if ($v['format']) {
                $tmp_format = $formats->where('id',$v['format'])->first()->attr_ids;
                // 查第一个的值
                $tmp_format = explode('-', trim($tmp_format,'-'))[0];
                $tmp_weight = $attrs->where('id',$tmp_format)->first()->value;
                $tmp_good['weight'] = (float) $tmp_weight;
                $tmp_good['total_weight'] = $v['nums'] * (float) $tmp_weight;
            }
            else
            {
                $tmp_good['total_weight'] = $v['nums'] * $tmp_good['weight'];
            }
            unset($v['good_id']);
            unset($v['format']);
            $good_ship[$k] = array_merge($tmp_good,$v);
        }
        $cellData = array_merge(
            [['ID','标题','货号','单价','单件重量','数量','总重量']],$good_ship
        );
        Excel::create('今日销售统计表',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }
    public function getLeft($pid)
    {
        // 权限url
        $allUrl = $this->allPriv();
        // 二级菜单
        $left = $this->menu->where('parentid','=',$pid)->where('display','=','1')->orderBy('listorder','asc')->get()->toArray();
        $leftmenu = array();
        // 判断权限
        if (!in_array(1, session('user')->allRole))
        {
            foreach ($left as $k => $v) {
                foreach ($allUrl as $url) {
                    if ($v['url'] == $url) {
                        $leftmenu[$k] = $v;
                    }
                }
            }
        }
        else
        {
            $leftmenu = $left;
        }
        // 三级菜单
        foreach ($leftmenu as $k => $v) {
            // 取所有下级菜单
            $res = $this->menu->where('parentid','=',$v['id'])->where('display','=','1')->orderBy('listorder','asc')->get()->toArray();
            // 进行权限判断
            if (!in_array(1, session('user')->allRole))
            {
                foreach ($res as $s => $v) {
                    foreach ($allUrl as $url) {
                        if ($v['url'] == $url) {
                            $leftmenu[$k]['submenu'][$s] = $v;
                        }
                    }
                }
            }
            else
            {
                $leftmenu[$k]['submenu'] = $res;
            }
        }
        // dd($leftm enu);
        return view('admin.left',compact('leftmenu'));
    }
    // 查出所有有权限的url
    private function allPriv()
    {
        $rid = session('user')->allRole;
        // 查url
        $priv = Priv::whereIn('role_id',$rid)->pluck('url')->toArray();
        return $priv;
    }

    // 更新缓存
    public function getCache()
    {
        $config = Config::select('sitename','title','keyword','describe','theme','person','phone','email','address','content')->findOrFail(1)->toArray();
        Cache::forever('config',$config);
        echo "<p class='color-green'>更新系统缓存成功...</p>";
        App::make('com')->updateCache(new App\Models\Cate,'cateCache');
        echo "<p class='color-green'>更新栏目缓存成功...</p>";
        App::make('com')->updateCache(new App\Models\Menu,'menuCache');
        echo "<p class='color-green'>更新后台菜单缓存成功...</p>";
        App::make('com')->updateCache(new App\Models\GoodCate,'goodcateCache');
        echo "<p class='color-green'>更新商品分类缓存成功...</p>";
        App::make('com')->updateCache(new App\Models\Type,'typeCache');
        echo "<p class='color-green'>更新分类缓存成功...</p>";
        echo "<p class='color-red'>更新缓存完成...</p>";
    }
}
