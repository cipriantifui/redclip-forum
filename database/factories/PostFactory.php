<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'topic_id' => Topic::factory(),
            'user_id' => Topic::factory(),
            'uid' => null,
            'title' => $this->faker->text(20),
            'content' => $this->faker->text(1000),
            'url_image' => $this->faker->imageUrl(),
            'url_video' => $this->faker->imageUrl(),
            'is_published' => $this->faker->boolean(90)
        ];
    }
}
