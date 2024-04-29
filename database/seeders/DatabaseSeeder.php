<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
            'password'=>bcrypt('kyawkyawhein'),
        ]);
        User::factory(20)->create();
        User::factory()->create([
            "name" => "Kyaw Kyaw Hein",
            "email" => "hhein6223@gmail.com",
            "password"=>bcrypt('kyawkyawhein'),
        ]);
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            RecommendSeeder::class,
        ]);
    }
}
