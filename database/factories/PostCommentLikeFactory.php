<?php

namespace Database\Factories;

use App\Models\PostCommentLike;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCommentLikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostCommentLike::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_id' => $this->faker->numberBetween(1, 100),
            'user_id' => $this->faker->numberBetween(1, 10),
            'uid' => null,
        ];
    }
}
