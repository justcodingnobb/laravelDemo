<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalesSortToGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->integer('sort')->default(0)->after('xlnums')->comment('排序');
            $table->integer('sales')->default(0)->after('sort')->comment('销量');
            $table->decimal('score',10,2)->default(0)->after('sales')->comment('评分');
            $table->integer('commentnums')->default(0)->after('score')->comment('评论数');
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
