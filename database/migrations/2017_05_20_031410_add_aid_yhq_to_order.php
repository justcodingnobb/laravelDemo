<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAidYhqToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('address_id')->default(0)->after('user_id')->comment('送货地址');
            $table->integer('yhq_id')->default(0)->after('address_id')->comment('优惠券id');
            $table->decimal('yh_price')->default(0)->after('yhq_id')->comment('优惠券金额');
            $table->decimal('old_prices')->default(0)->after('yh_price')->comment('原价');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
