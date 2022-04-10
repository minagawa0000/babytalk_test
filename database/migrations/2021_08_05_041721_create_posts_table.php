<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->text('image')->nullable();
            $table->time('getup_time');
            $table->string('breakfast');
            $table->string('morning_time');
            $table->string('lunch');
            $table->string('after_time');
            $table->string('dinner');
            $table->time('sleep_time');
            $table->unsignedBigInteger('prefecture_id');
            $table->unsignedBigInteger('babyage_scope_id');
            $table->char('year',4);
            $table->char('month',2);
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('posts');
    }
}
