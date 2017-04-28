<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     * 购物车
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('session_id')->index()->comment('sessionId');
            $table->integer('user_id')->comment("用户ID");
            $table->integer('good_id')->comment("商品ID");
            $table->integer('format_id')->comment("商品属性ID");
            $table->integer('nums')->default(0)->comment("数量");
            $table->decimal('price',10,2)->default(0)->comment("价格");
            $table->decimal('total_prices',10,2)->default(0)->comment("总价");
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
        Schema::dropIfExists('carts');
    }
}
