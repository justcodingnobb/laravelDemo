<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoodSpec extends Migration
{
    /**
     * 规格表
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_spec', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('good_cate_id')->default(0)->comment('商品分类');
            $table->string('name',255)->comment('规格名称');
            $table->tinyInteger('search_type')->default(1)->comment('是否需要检索：1是，0否');
            $table->integer('sort')->default(0)->comment('排序');
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
        Schema::dropIfExists('good_spec');
    }
}
