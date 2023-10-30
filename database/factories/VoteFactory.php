<?php

namespace Database\Factories;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 8),
            'votable_type' => $this->faker->randomElement(['App\Models\PostComment', 'App\Models\Post']),
            'votable_id' => $this->faker->numberBetween(1, 10),
            'uid' => null,
        ];
    }
}
