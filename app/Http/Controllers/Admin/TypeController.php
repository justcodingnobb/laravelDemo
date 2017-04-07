<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\TypeRequest;
use App\Models\Type;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * 分类列表
     * @return [type] [description]
     */
    public function getIndex()
    {
    	$title = '分类管理';
        // 超级管理员可查看所有部门下分类
        $all = Type::orderBy('listorder','asc')->get();
        $tree = App::make('com')->toTree($all,'0');
    	$treeHtml = $this->toTreeHtml($tree);
    	return view('admin.type.index',compact('title','treeHtml'));
    }
    // 树形菜单 html
    private function toTreeHtml($tree)
    {
        $html = '';
        if (is_array($tree)) {
            foreach ($tree as $v) {
                // 用level判断层级，最好不要超过四层，样式中只写了四级
                $cj = count(explode(',', $v['arrparentid']));
                $level = $cj > 4 ? 4 : $cj;
                $html .= "<tr>
                    <td>".$v['listorder']."</td>
                    <td>".$v['id']."</td>
                    <td><span class='level-".$level."'></span>".$v['name']."<a href='/admin/type/add/".$v['id']."' class='glyphicon glyphicon-plus add_submenu'></a></td>
                    <td><a href='/admin/type/edit/".$v['id']."' class='btn btn-sm btn-info'>修改</a> <a href='/admin/type/del/".$v['id']."' class='confirm btn btn-sm btn-danger'>删除</a></td>
                    </tr>";
                if ($v['parentid'] != '')
                {
                    $html .= $this->toTreeHtml($v['parentid']);
                }
            }
        }
        return $html;
    }
    /**
     * 添加分类
     * @param  integer $pid [父分类ID]
     * @return [type]       [description]
     */
    public function getAdd($pid = '0')
    {
    	$title = '添加分类';
    	return view('admin.type.add',compact('title','pid'));
    }
    public function postAdd(TypeRequest $res,$pid = '0')
    {
        // 开启事务
        DB::beginTransaction();
        try {
            $data = $res->input('data');
            $resId = Type::create($data);
            // 后台用户组权限
            App::make('com')->updateCache(new Type,'typeCache');
            // 没出错，提交事务
            DB::commit();
            return redirect('/admin/type/index')->with('message', '添加成功！');
        } catch (Exception $e) {
            // 出错回滚
            DB::rollBack();
            return back()->with('message','添加失败，请稍后再试！');
        }
    }
    /**
     * 修改分类
     * @param  string $id [要修改的分类ID]
     * @return [type]     [description]
     */
    public function getEdit($id = '')
    {
        $title = '修改分类';
        $info = Type::findOrFail($id);
        $all = Type::orderBy('listorder','asc')->get();
        $tree = App::make('com')->toTree($all,'0');
        $treeHtml = App::make('com')->toTreeSelect($tree,$info->parentid);
        return view('admin.type.edit',compact('title','info','treeHtml'));
    }
    public function postEdit(TypeRequest $res,$id = '')
    {
        // 开启事务
        DB::beginTransaction();
        try {
            $data = $res->input('data');
            Type::where('id',$id)->update($data);
            // 更新缓存
            App::make('com')->updateCache(new Type,'typeCache');
            // 没出错，提交事务
            DB::commit();
            return redirect('/admin/type/index')->with('message', '修改成功！');
        } catch (Exception $e) {
            // 出错回滚
            DB::rollBack();
            return back()->with('message','修改失败，请稍后再试！');
        }
    }
    public function getDel($id)
    {
        // 先找出所有子分类，再判断子分类中是否有文章，如果有文章，返回错误
        $allChild = Type::where('id',$id)->value('arrchildid');
        // 所有子分类ID转换为集合，查看是否含有文章或者专题
        $childs = collect(explode(',',$allChild));
        // 开启事务
        DB::beginTransaction();
        try {
            Type::destroy($childs);
            $message = '删除成功！';
            // 没出错，提交事务
            DB::commit();
        } catch (Exception $e) {
            // 出错回滚
            DB::rollBack();
            return back()->with('message','删除失败，请稍后再试！');
        }
        return back()->with('message', $message);
    }
}
