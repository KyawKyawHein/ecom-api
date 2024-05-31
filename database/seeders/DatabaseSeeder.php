<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Color;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Size;
use App\Models\User;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('kyawkyawhein'),
        ]);
        User::factory(20)->create();
        User::factory()->create([
            "name" => "Kyaw Kyaw Hein",
            "email" => "hhein6223@gmail.com",
            "password" => bcrypt('kyawkyawhein'),
        ]);
        Shop::factory()->create([
            "shopId" => 611,
            "name" => "MODAMATE"
        ]);
        $this->call([
            CategorySeeder::class,
            RecommendSeeder::class,
        ]);
        //size seeder
        $sizes = ['XS', 'SM', 'M', 'L', 'XL', '2XL', '3XL'];
        foreach ($sizes as $size) {
            Size::create([
                "name" => $size
            ]);
        }

        // color seeder
        // $products = Product::factory(4)->create();


        //attach
        // foreach ($products as $product) {
        //     foreach (Size::all() as $sizeId) {
        //         $product->sizes()->attach($colorId, [
        //             'size_id' => $sizeId->id,
        //             'quantity' => fake()->numberBetween(1, 10),
        //         ]);
        //     }
        // }

    }
}
