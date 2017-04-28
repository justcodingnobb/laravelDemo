<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     * 订单所属商品表
     * @return void
     */
    public function up()
    {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->comment("用户ID");
            $table->integer('order_id')->comment("订单ID");
            $table->integer('good_id')->comment("商品ID");
            $table->integer('format_id')->comment("商品属性ID");
            $table->integer('nums')->default(0)->comment("数量");
            $table->decimal('price',10,2)->default(0)->comment("价格");
            $table->decimal('total_prices',10,2)->default(0)->comment("总价");
            $table->tinyInteger('status')->default(1)->comment('状态，1正常0删除');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_goods');
    }
}
