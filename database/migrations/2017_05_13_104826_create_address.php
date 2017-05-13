<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddress extends Migration
{
    /**
     *
     * 送货地址-address
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment("用户ID");
            $table->string('address',255)->comment('地址');
            $table->string('phone',15)->comment('电话');
            $table->string('people',50)->comment('联系人');
            $table->tinyInteger('default')->default(0)->comment('状态：1默认，0普通');
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
        Schema::dropIfExists('address');
    }
}
