<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(30)->create();
        Product::factory(10)->create([
            "category_id"=>11
        ]);
        Product::factory(10)->create([
            "category_id"=>12
        ]);
    }
}
