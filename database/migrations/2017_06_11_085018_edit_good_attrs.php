<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditGoodAttrs extends Migration
{
    /**
     * 更改属性表
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('good_attrs', function (Blueprint $table) {
            $table->dropColumn(['parentid','status','unit']);
            $table->integer('good_cate_id')->default(0)->after('id')->comment('商品分类');
            $table->tinyInteger('search_type')->default(0)->after('name')->comment('索引类型：0不需要检索 1关键字检索 2范围检索');
            $table->tinyInteger('type')->default(0)->after('search_type')->comment('0唯一属性 1单选属性 2复选属性');
            $table->tinyInteger('input_type')->default(0)->after('type')->comment('0 手工录入 1从列表中选择 2多行文本框');
            $table->integer('sort')->default(0)->after('value')->comment('排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('good_attrs', function (Blueprint $table) {
            //
        });
    }
}
