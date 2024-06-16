<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => $this->faker->numberBetween(1, 2),
            "body" => $this->faker->unique()->sentence,
            "commentable_type" => "App\Models\Vacancy",
            "commentable_id" => $this->faker->numberBetween(1, 10),
            "created_at" => "2024-05-01 02:57:00",
            "updated_at" => "2024-05-01 02:57:00",
        ];
    }
}
