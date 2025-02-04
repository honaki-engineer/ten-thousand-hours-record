<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostForm>
 */
class PostFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'study_seconds' => $this->faker->randomNumber(4),
            'status' => $this->faker->numberBetween(1, 3),
            'comment' => $this->faker->realText(20),
            'user_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
