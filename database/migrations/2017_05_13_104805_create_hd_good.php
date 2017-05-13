<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHdGood extends Migration
{
    /**
     * 活动商品-hd_good
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hd_good', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->comment("用户ID");
            $table->integer('hd_id')->comment("活动ID");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hd_good');
    }
}
