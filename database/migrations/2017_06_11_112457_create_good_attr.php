<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodAttr extends Migration
{
    /**
     * 商品属性对应关系表
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_attr', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('good_id')->default(0)->comment('商品id');
            $table->integer('good_attr_id')->default(0)->comment('商品属性id');
            $table->string('good_attr_value')->default('')->comment('商品属性值');
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
        Schema::dropIfExists('good_attr');
    }
}
