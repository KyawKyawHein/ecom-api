<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Branch;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Fake;

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
        Branch::factory()->create([
            "branchId" => 611,
            "branchName" => "Kyimyindine"
        ]);
        $this->call([
            CategorySeeder::class,
            RecommendSeeder::class,
            ProductSeeder::class,
        ]);
        //size seeder
        $sizes = ['XS', 'SM', 'M', 'L', 'XL', '2XL', '3XL'];
        foreach ($sizes as $size) {
            Size::create([
                "name" => $size
            ]);
        }
        //color_product_size
        $faker =Fake::create();
        foreach (Product::all() as $product) {
            $sizes = Size::all()->random(3);
            $randomColors =[];
            for($i=0;$i<3;$i++){
                $randomColors[]=$faker->hexColor();
            };
            foreach($sizes as $size){
                foreach($randomColors as $color){
                    $product->sizes()->attach($size->id, [
                        'color' => $color,
                        'quantity' => fake()->numberBetween(1, 10),
                    ]);
                }
            }
        }


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
