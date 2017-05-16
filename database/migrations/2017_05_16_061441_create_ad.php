<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAd extends Migration
{
    /**
     * 广告位
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pos_id')->comment('位置ID');
            $table->string('title',255)->comment('标题');
            $table->string('thumb',255)->comment('图片');
            $table->string('url',255)->comment('商品链接');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态：1正常，0关闭');
            $table->tinyInteger('del')->default(1)->comment('状态：1正常，0删除');
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
        Schema::dropIfExists('ads');
    }
}
