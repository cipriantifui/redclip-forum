<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comment_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id');
            $table->foreignId('user_id')->nullable();
            $table->unsignedBigInteger('uid')->nullable();
            $table->timestamps();

            $table->foreign('comment_id', 'comment_id_fk_post_comment_likes')->references('id')->on('post_comments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'user_id_fk_post_comment_likes')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_comment_likes');
    }
}
