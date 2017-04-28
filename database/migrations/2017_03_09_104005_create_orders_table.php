<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     * 订单表
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('order_id',20)->comment('订单ID');
            $table->integer('user_id')->comment("用户ID");
            $table->decimal('total_prices',10,2)->default(0)->comment("总价");
            $table->string('create_ip',50)->comment('创建IP');
            $table->tinyInteger('paystatus')->default(0)->comment("支付状态,0未，1已");
            $table->tinyInteger('shipstatus')->default(0)->comment("发货状态,0未，1已");
            $table->tinyInteger('orderstatus')->default(1)->comment("订单状态，1正常2完成0关闭");
            $table->tinyInteger('status')->default(1)->comment('状态，1正常0删除');
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
        Schema::dropIfExists('orders');
    }
}
