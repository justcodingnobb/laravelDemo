<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Config;
use App\Models\Consume;
use App\Models\Good;
use App\Models\GoodAttr;
use App\Models\GoodFormat;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\Priv;
use Cache;
use Excel;
use Illuminate\Http\Request;

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
    // 今日消费情况
    public function getConsume(Request $req)
    {
        $title = '消费情况';
        // 今日销售统计表，先查出今天的已付款订单，再按订单查出所有产品及属性
        $starttime = isset($req->starttime) ? $req->starttime : date('Y-m-d 00:00:00');
        $endtime = isset($req->endtime) ? $req->endtime : date('Y-m-d 24:00:00');
        $consume = Consume::with(['user'=>function($q){
                    $q->select('id','username','nickname','openid','phone');
                }])->where('created_at','>',$starttime)->where('created_at','<',$endtime)->orderBy('user_id','asc')->get();
        // 今日总入账、出账、结余
        $today_inc = Consume::where('created_at','>',$starttime)->where('created_at','<',$endtime)->where('type',0)->orderBy('user_id','asc')->sum('price');
        $today_dec = Consume::where('created_at','>',$starttime)->where('created_at','<',$endtime)->where('type',1)->orderBy('user_id','asc')->sum('price');
        $today_over = $today_inc - $today_dec;
        return view('admin.index.consume',compact('starttime','endtime','title','consume','today_dec','today_inc','today_over'));
    }
    public function getExcelConsume(Request $req)
    {
        $title = '消费情况';
        // 今日销售统计表，先查出今天的已付款订单，再按订单查出所有产品及属性
        $starttime = isset($req->starttime) ? $req->starttime : date('Y-m-d 00:00:00');
        $endtime = isset($req->endtime) ? $req->endtime : date('Y-m-d 24:00:00');
        $consume = Consume::with(['user'=>function($q){
                    $q->select('id','username','nickname','openid','phone');
                }])->where('created_at','>',$starttime)->where('created_at','<',$endtime)->orderBy('user_id','asc')->get();
        $tmp = [];
        foreach ($consume as $v) {
            $username = is_null($v->user) ? '' : $v->user->nickname;
            $typename = $v->type ? '充值' : '消费';
            $tmp[] = [$username,$v->mark,$v->price,$typename,$v->created_at];
        }

        $cellData = array_merge(
            [['用户','备注','金额','类型','时间']],$tmp
        );
        Excel::create('消费情况统计表',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }
    /**
     * 主要信息展示
     */
    public function getMain()
    {
        $title = '系统信息';
        $data = [];
        $starttime = date('Y-m-d 00:00:00');
        $endtime = date('Y-m-d 24:00:00');
        // $starttime = date('2017-05-01 00:00:00');
        // $endtime = date('2017-06-12 24:00:00');
        // 今日总订单量
        $data['today_ordernum'] = Order::where('orderstatus','>',0)->where('created_at','>',date('Y-m-d 00:00:00'))->count();
        // 今日销售额
        $data['today_prices'] = Order::where('orderstatus','>',0)->where('created_at','>',date('Y-m-d 00:00:00'))->sum('total_prices');
        // 今日已收款数
        $data['today_prices_real'] = Consume::where('created_at','>',$starttime)->where('created_at','<',$endtime)->where('type',0)->orderBy('user_id','asc')->sum('price');
        // 今日未收款数
        $data['today_prices_no'] = $data['today_prices'] - $data['today_prices_real'];
        // 今日待发货
        $data['today_ship'] = Order::where('orderstatus',1)->where('shipstatus',0)->where('ziti',0)->where('created_at','>',date('Y-m-d 00:00:00'))->where('paystatus',1)->count();
        // 今日销售统计表，先查出今天的已付款订单，再按订单查出所有产品及属性
        $order_ids = Order::where('orderstatus',1)->where('paystatus',1)->where('created_at','>',date('Y-m-d 00:00:00'))->pluck('id');
        $goods = OrderGood::whereIn('order_id',$order_ids)->get();
        // 循环出来每一个产品的重量值，并去重累加
        $good_ship = [];
        foreach ($goods as $k => $v) {
            if (isset($good_ship[$v->good_id.'_'.$v->good_spec_key])) {
                $good_ship[$v->good_id.'_'.$v->good_spec_key]['nums'] += $v->nums;
            }
            else
            {
                $good_ship[$v->good_id.'_'.$v->good_spec_key] = ['good_id'=>$v->good_id,'nums'=>$v->nums,'spec_key'=>$v->good_spec_key,'good_spec_name'=>$v->good_spec_name,'price'=>$v->price];
            }
        }
        // 查每个的重量并累加，先查出所有商品属性及商品规格，省去重复查询
        $goods_weigth = Good::whereIn('id',$goods->pluck('good_id'))->select('id','title','pronums','weight')->get();
        foreach ($good_ship as $k => $v) {
            $tmp_good = $goods_weigth->where('id',$v['good_id'])->first()->toArray();
            $tmp_good['total_weight'] = $v['nums'] * $tmp_good['weight'];
            $tmp_good['total_prices'] = $v['nums'] * $v['price'];
            unset($v['good_id']);
            $good_ship[$k] = array_merge($tmp_good,$v);
        }
        return view('admin.index.main',compact('title','data','good_ship'));
    }
    public function getExcelGoods(Request $req)
    {
        // 今日销售统计表，先查出今天的已付款订单，再按订单查出所有产品及属性
        $starttime = $req->starttime;
        $endtime = $req->endtime;
        $order_ids = Order::where('orderstatus',1)->where('paystatus',1)->where('created_at','>',$starttime)->where('created_at','<',$endtime)->pluck('id');
        $goods = OrderGood::whereIn('order_id',$order_ids)->get();

        // 循环出来每一个产品的重量值，并去重累加
        $good_ship = [];
        foreach ($goods as $k => $v) {
            if (isset($good_ship[$v->good_id.'_'.$v->good_spec_key])) {
                $good_ship[$v->good_id.'_'.$v->good_spec_key]['nums'] += $v->nums;
            }
            else
            {
                $good_ship[$v->good_id.'_'.$v->good_spec_key] = ['good_id'=>$v->good_id,'nums'=>$v->nums,'spec_key'=>$v->good_spec_key,'good_spec_name'=>$v->good_spec_name,'price'=>$v->price];
            }
        }
        // 查每个的重量并累加，先查出所有商品属性及商品规格，省去重复查询
        $goods_weigth = Good::whereIn('id',$goods->pluck('good_id'))->select('id','title','pronums','weight')->get();
        foreach ($good_ship as $k => $v) {
            $tmp_arr = [];
            $tmp_good = $goods_weigth->where('id',$v['good_id'])->first()->toArray();
            $tmp_arr['id'] = $v['good_id'];
            $tmp_arr['title'] = $tmp_good['title'];
            $tmp_arr['good_spec_name'] = $v['good_spec_name'];
            $tmp_arr['pronums'] = $tmp_good['pronums'];
            $tmp_arr['price'] = $v['price'];
            $tmp_arr['weight'] = $tmp_good['weight'];
            $tmp_arr['nums'] = $v['nums'];
            $tmp_arr['total_weight'] = $v['nums'] * $tmp_good['weight'];
            $tmp_arr['total_prices'] = $v['nums'] * $v['price'];
            $good_ship[$k] = $tmp_arr;
        }
        $cellData = array_merge(
            [['ID','标题','规格','货号','单价','单件重量','数量','总重量','总价']],$good_ship
        );
        Excel::create('今日销售统计表',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }
    public function getExcelOrders(Request $req)
    {
        // 今日销售统计表，先查出今天的已付款订单，再按订单查出所有产品及属性
        $starttime = $req->starttime;
        $endtime = $req->endtime;
        $orders = Order::with(['address'=>function($q){
                        $q->select('id','area','address','phone','people');
                    },'zitidian'=>function($q){
                        $q->select('id','area','address','phone');
                    },'user'=>function($q){
                        $q->select('id','nickname','address','phone');
                    }])->where('orderstatus',1)->where('paystatus',1)->where('created_at','>',$starttime)->where('created_at','<',$endtime)->get();
        $goods = OrderGood::whereIn('order_id',$orders->pluck('id'))->get();

        // 循环每个订单的订单信息
        $excel = [];
        foreach ($orders as $k => $v) {
            // 查有几个商品
            $tmp_good = $goods->where('order_id',$v->id)->all();
            $first_gid = $goods->where('order_id',$v->id)->first()->good_id;
            foreach ($tmp_good as $kg => $g) {
                $tmp = [];
                $title = $g['good_title'];
                // 判断是否有规格
                if ($g['good_spec_key'] != '') {
                    $title .= ' - '.$g['good_spec_name'];
                }
                // 第一个订单产品写出详细信息来
                if ($g->good_id == $first_gid) {
                    // 判断是自提还是配送
                    if (!is_null($v->address)) {
                        $tmp = [$v->address->people,$v->address->phone,'','河北','衡水',$v->address->area,$v->address->address,$v->total_prices,$v->mark,$v->shopmark,$title,$g['nums'],''];
                    }
                    else
                    {
                        $tmp = [$v->user->nickname.'（自提）',$v->user->phone,'','河北','衡水',$v->zitidian->area,$v->zitidian->address,$v->total_prices,$v->mark,$v->shopmark,$title,$g['nums'],''];
                    }
                    $excel[] = $tmp;
                }
                else
                {
                    $tmp = ['','','','','','','','','','',$title,$g['nums'],''];
                    $excel[] = $tmp;
                }
            }
            $tmp_good = null;
        }
        $cellData = array_merge(
            [["1、有底色却有*标记的列为必填项，仅带*建议填写，其他为选填；
2、地址和收件人、手机、电话相同的订单会自动合并；
3、同一个订单有多种商品，订单信息不用再输入，只需输入商品信息（如3至5行）；
4、禁止合并单元格；
5、表头、本注释（即1、2行）不能删除；
6、以下数据（3至7行）为举例数据，可删除然后输入您的订单数据；
7、如果“代收货款金额”大于0则视为货到付款订单；"                                              
]],
            [['收件人姓名*','手机*','电话','省*','市*','区*','地址*','订单金额','买家留言','卖家备忘','物品名称','数量','代收货款金额']]
            ,$excel
        );
        Excel::create('发货易订单打印表',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->mergeCells('A1:M1');
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
