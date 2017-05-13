<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManzeng extends Migration
{
    /**
     *
     * 满赠-manzeng
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manzeng', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->comment("商品ID");
            $table->string('title',255)->comment('标题');
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
        Schema::dropIfExists('manzeng');
    }
}
