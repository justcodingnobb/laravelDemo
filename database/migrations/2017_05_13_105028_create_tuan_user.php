<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTuanUser extends Migration
{
    /**
     *
     * 参团用户-tuan_user
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tuan_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment("用户ID");
            $table->integer('t_id')->comment("团购ID");
            $table->tinyInteger('status')->default(1)->comment('参加状态：1正常，0取消');
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
        Schema::dropIfExists('tuan_user');
    }
}
