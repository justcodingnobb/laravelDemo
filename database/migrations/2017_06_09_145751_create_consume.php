<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsume extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consume', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment("用户ID");
            $table->integer('order_id')->default(0)->comment("订单ID");
            $table->string('price',15)->default(0)->comment("金额");
            $table->string('mark',500)->default('')->comment('备注');
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
        Schema::dropIfExists('consume');
    }
}
