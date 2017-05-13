<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollect extends Migration
{
    /**
     * 收藏-collect
     * 
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collect', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment("用户ID");
            $table->integer('good_id')->comment("商品ID");
            $table->string('title',255)->comment('商品标题');
            $table->string('thumb',255)->comment('图片');
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
        Schema::dropIfExists('collect');
    }
}
