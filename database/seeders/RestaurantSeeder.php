<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Restaurant::truncate();
        });

        for ($i = 0; $i < 10; $i++) {

            Restaurant::create([
                'name' => fake()->company(),
                'address' => fake()->address(),
                'partita_iva' => fake()->randomNumber(9, true),
                'image' => fake()->imageUrl(640, 480, 'food', true),
                'user_id' => rand(1, 10),
            ]);
        }
    }
}
