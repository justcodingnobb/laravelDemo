<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('user_money')->default(0)->after('nickname')->comment('余额');
            $table->integer('points')->default(0)->after('user_money')->comment('积分');
            $table->tinyInteger('sex')->default(0)->after('points')->comment('性别');
            $table->string('birthday',25)->default('1970-00-00')->after('sex')->comment('生日');
            $table->string('thumb',255)->nullable()->after('nickname')->comment('头像');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
