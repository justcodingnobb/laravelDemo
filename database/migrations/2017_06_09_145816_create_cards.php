<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0)->comment("用户ID");
            $table->string('card_id',20)->comment("会员卡号");
            $table->string('card_pwd',20)->comment("会员卡密码");
            $table->decimal('price',10,2)->default(0)->comment("金额");
            $table->tinyInteger('status')->default(0)->comment('状态，0未用 1已用');
            $table->timestamp('init_time')->comment('使用时间');
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
        Schema::dropIfExists('cards');
    }
}
