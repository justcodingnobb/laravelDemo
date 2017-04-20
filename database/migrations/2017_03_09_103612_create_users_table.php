<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * 用户表
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('gid')->default(1)->comment("组ID");
            $table->string('username',30)->nullable()->comment('用户名');
            $table->string('password',200)->nullable()->comment('密码');
            $table->string('token',255)->nullable()->comment("API登陆用");
            $table->string('email',100)->nullable()->comment('邮箱');
            $table->string('nickname',30)->nullable()->comment('昵称');
            $table->string('phone',20)->nullable()->comment('手机号');
            $table->string('address',200)->nullable()->comment('地址');
            $table->string('last_ip',30)->nullable()->comment('最后登陆IP');
            $table->timestamp('last_time')->nullable()->comment('最后登陆时间');
            $table->tinyInteger('status')->default(1)->comment('状态，1正常0禁用');
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
        Schema::dropIfExists('users');
    }
}
