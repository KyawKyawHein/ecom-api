<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "branchId"=>611,
            "name"=>fake()->name(),
            "slug"=>fake()->slug(),
            "image"=>"https://i.pravatar.cc/150?img=".rand(1,70),
            "description"=>fake()->sentence(),
            "price"=>fake()->numberBetween(1000,10000),
            // "stock_quantity"=>fake()->randomDigit(),
            "category_id"=>Category::all()->random()->id,
        ];
    }
}
