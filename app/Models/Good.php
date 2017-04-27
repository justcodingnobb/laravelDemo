<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
	// 商品表
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'goods';

    // 不可以批量赋值的字段，为空则表示都可以
    protected $guarded = [];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $hidden = [];
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = true;

    // 属性值
    public function format()
    {
        return $this->hasMany('\App\Models\GoodFormat','good_id','id');
    }
    // 关联商品分类
    public function goodcate()
    {
        return $this->belongsTo('\App\Models\GoodCate','cate_id','id');
    }
    // 关联订单
    public function order_good()
    {
        return $this->hasMany('\App\Models\OrderGood','good_id','id');
    }
}
