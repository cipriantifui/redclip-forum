<?php

namespace Database\Seeders;

use App\Models\PostComment;
use Database\Factories\CommentReplyFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();
        DB::table('topics')->truncate();
        DB::table('posts')->truncate();
        DB::table('post_votes')->truncate();
        DB::table('post_comments')->truncate();


         \App\Models\User::factory(10)->create();
         \App\Models\Topic::factory(10)->create();

        $this->call(PostSeeder::class);

        \App\Models\PostVote::factory(50)->create();
        \App\Models\PostComment::factory(50)->create()->each(function ($post) {
            \App\Models\PostComment::factory(rand(0,3))->create(['parent_id' => $post->id]);
        });
        \App\Models\PostCommentLike::factory(100)->create();
    }
}
