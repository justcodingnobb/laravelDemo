<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditReturnGoodSpec extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('return_good', function (Blueprint $table) {
            $table->dropColumn('format_id');
            $table->string('good_title')->default('')->nullable()->after('good_id')->comment('商品名称');
            $table->string('good_spec_key')->default('')->nullable()->after('good_title')->comment('商品规格key');
            $table->string('good_spec_name')->default('')->nullable()->after('good_spec_key')->comment('商品规格组合名称');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('return_good', function (Blueprint $table) {
            //
        });
    }
}
