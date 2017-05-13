<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYhqUser extends Migration
{
    /**
     * 用户优惠券-yhq_user
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yhq_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->comment("用户ID");
            $table->integer('yhq_id')->comment("优惠券ID");
            $table->timestamp('endtime')->comment('结束时间');
            $table->tinyInteger('status')->default(1)->comment('状态：1正常，0已用');
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
        Schema::dropIfExists('yhq_user');
    }
}
