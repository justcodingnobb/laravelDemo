<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditOrderGoodss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_goods', function (Blueprint $table) {
            $table->dropColumn('format_id');
            $table->string('good_title')->default('')->nullable()->after('good_id')->comment('商品名称');
            $table->string('good_spec_key')->default('')->nullable()->after('good_title')->comment('商品规格key');
            $table->string('good_spec_name')->default('')->nullable()->after('good_spec_key')->comment('商品规格组合名称');
            $table->tinyInteger('type')->default(0)->after('commentstatus')->comment('0普通订单,1团购');
            $table->tinyInteger('shipstatus')->default(0)->after('type')->comment('0未发货，1已发货，2已换货，3已退货');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_goods', function (Blueprint $table) {
            //
        });
    }
}
