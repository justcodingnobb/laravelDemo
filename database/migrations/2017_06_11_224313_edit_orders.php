<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('pay_name')->nullable()->after('paystatus')->comment('支付方式');
            $table->timestamp('ship_at')->nullable()->after('shipstatus')->comment('发货时间');
            $table->timestamp('confirm_at')->nullable()->after('orderstatus')->comment('确认收货时间');
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
