<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recommend>
 */
class RecommendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = range(1,20);
        shuffle($userIds);
        return [
            "user_id" =>array_shift($userIds),
            "shopId" => 611,
            "text" => fake()->sentence(20)
        ];
    }
}
