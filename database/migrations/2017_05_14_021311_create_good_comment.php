<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('good_comment', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->comment("用户ID");
            $table->integer('good_id')->comment("商品ID");
            $table->string('title',255)->comment('标题');
            $table->string('content',1000)->comment('内容');
            $table->decimal('score',10,2)->default(5)->comment('评分');
            $table->tinyInteger('del')->default(1)->comment('状态：1正常，0删除');
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
        Schema::dropIfExists('good_comment');
    }
}
