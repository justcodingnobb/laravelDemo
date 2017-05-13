<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddXsXlToGood extends Migration
{
    /**
     *
     * 限时，限量
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->integer('store')->default(100)->after('price')->comment('库存');
            $table->tinyInteger('isxs')->default(0)->after('store')->comment('是否限时：1是，0否');
            $table->timestamp('starttime')->nullable()->after('isxs')->comment('限时开始时间');
            $table->timestamp('endtime')->nullable()->after('starttime')->comment('限时结束时间');
            $table->tinyInteger('isxl')->default(0)->after('endtime')->comment('是否限量：1是，0否');
            $table->integer('xlnums')->default(1)->after('isxl')->comment('限制数量');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods', function (Blueprint $table) {
            //
        });
    }
}
