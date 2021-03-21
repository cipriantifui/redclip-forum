<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'topic_id' => 6,
            'user_id' => 9,
            'uid' => null,
            'title' => 'What is Lorem Ipsum?',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'is_published' => 1
        ]);

        Post::create([
            'topic_id' => 2,
            'user_id' => 8,
            'uid' => null,
            'title' => 'Blue sky white clouds forest mountain',
            'url_image' => 'https://png.pngtree.com/illustration/20190226/ourmid/pngtree-blue-sky-white-clouds-forest-mountain-peak-image_7517.jpg',
            'is_published' => 1
        ]);

        Post::create([
            'topic_id' => 6,
            'user_id' => 5,
            'uid' => null,
            'title' => 'What is Lorem Ipsum?',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'is_published' => 1
        ]);

        Post::create([
            'topic_id' => 1,
            'user_id' => 1,
            'uid' => null,
            'title' => 'What is Lorem Ipsum?',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'is_published' => 1
        ]);

        Post::create([
            'topic_id' => 3,
            'user_id' => 2,
            'uid' => null,
            'title' => 'Big Buck Bunny',
            'url_video' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
            'is_published' => 1
        ]);

        Post::create([
            'topic_id' => 3,
            'user_id' => 4,
            'uid' => null,
            'title' => 'Elephant Dream',
            'url_video' => 'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
            'is_published' => 1
        ]);

        Post::create([
            'topic_id' => 2,
            'user_id' => 1,
            'uid' => null,
            'title' => 'Panda developer',
            'url_image' => 'http://www.titikshapublicschool.com/wp-content/uploads/2018/11/developer-api.jpg',
            'is_published' => 1
        ]);

        Post::create([
            'topic_id' => 1,
            'user_id' => 5,
            'uid' => null,
            'title' => 'What is Lorem Ipsum?',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
            'is_published' => 1
        ]);
    }
}
