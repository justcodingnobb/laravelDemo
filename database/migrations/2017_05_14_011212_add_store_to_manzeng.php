<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoreToManzeng extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manzeng', function (Blueprint $table) {
            $table->integer('store')->default(0)->after('title')->comment('库存');
            $table->integer('price')->default(0)->after('store')->comment('满多少');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manzeng', function (Blueprint $table) {
            //
        });
    }
}
