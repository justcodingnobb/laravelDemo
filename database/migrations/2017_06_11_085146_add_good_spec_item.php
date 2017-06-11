<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoodSpecItem extends Migration
{
    /**
     * 规格值
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_spec_item', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('good_spec_id')->default(0)->comment('商品规格id');
            $table->string('item',255)->comment('规格值');
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
        Schema::dropIfExists('good_spec_item');
    }
}
