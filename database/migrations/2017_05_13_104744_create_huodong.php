<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHuodong extends Migration
{
    /**
     *
     * 活动-HuoDong
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huodong', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title',255)->comment('标题');
            $table->string('thumb',255)->comment('图片');
            $table->timestamp('starttime')->comment('开始时间');
            $table->timestamp('endtime')->comment('结束时间');
            $table->tinyInteger('status')->default(1)->comment('状态：1正常，0关闭');
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
        Schema::dropIfExists('huodong');
    }
}
