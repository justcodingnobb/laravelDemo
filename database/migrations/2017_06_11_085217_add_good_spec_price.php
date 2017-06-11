<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoodSpecPrice extends Migration
{
    /**
     * 规格价格库存表
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_spec_price', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('good_id')->default(0)->comment('商品id');
            $table->string('key',255)->comment('规格键名，good_spec_item表的ID');
            $table->string('key_name',255)->comment('规格键名中文，good_spec_item表的item');
            $table->decimal('price',10,2)->default(0)->comment("价格");
            $table->integer('store')->default(10)->comment('库存');
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
        Schema::dropIfExists('good_spec_price');
    }
}
