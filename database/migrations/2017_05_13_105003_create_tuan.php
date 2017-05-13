<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTuan extends Migration
{
    /**
     *
     * 团购-tuan
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->comment("商品ID");
            $table->string('title',255)->comment('标题');
            $table->integer('nums')->default(0)->comment("开团人数");
            $table->integer('havnums')->default(0)->comment("参团人数");
            $table->integer('store')->default(0)->comment("库存");
            $table->decimal('prices',10,2)->default(0)->comment("团购价");
            $table->timestamp('starttime')->comment('开始时间');
            $table->timestamp('endtime')->comment('结束时间');
            $table->tinyInteger('status')->default(1)->comment('状态：1正常，0结束');
            $table->tinyInteger('del')->default(1)->comment('删除状态：1正常，0删除');
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
        Schema::dropIfExists('tuan');
    }
}
