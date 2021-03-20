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
            $table->foreignId('topic_id');
            $table->foreignId('user_id')->nullable();
            $table->unsignedBigInteger('uid')->nullable();
            $table->string('title');
            $table->text('content')->nullable();
            $table->text('url_image')->nullable();
            $table->text('url_video')->nullable();
            $table->boolean('is_published')->default(0);
            $table->timestamps();

            $table->foreign('topic_id', 'topic_id_fk_posts')->references('id')->on('topics')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'user_id_fk_users')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
