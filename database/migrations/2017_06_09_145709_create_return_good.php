<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnGood extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_good', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment("用户ID");
            $table->integer('order_id')->comment("订单ID");
            $table->integer('good_id')->comment("商品ID");
            $table->integer('format_id')->comment("商品属性ID");
            $table->string('mark',500)->default('')->comment('用户备注');
            $table->string('shopmark',500)->default('')->comment('商家备注');
            $table->integer('nums')->default(0)->comment("数量");
            $table->decimal('price',10,2)->default(0)->comment("价格");
            $table->decimal('total_prices',10,2)->default(0)->comment("总价");
            $table->tinyInteger('status')->default(0)->comment('状态，0未退1退2不同意');
            $table->tinyInteger('del')->default(1)->comment('状态，0删除 1正常');
            $table->timestamp('return_time')->comment('退货时间');
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
        Schema::dropIfExists('return_good');
    }
}
