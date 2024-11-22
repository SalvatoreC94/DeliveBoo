<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\Dish;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints( function() {
            Dish::truncate();
        });

        for ($i=0; $i< 10; $i++) { 
            
            Dish::create([

                'name' => fake()->name(),
                'description' => fake()->sentence(),
                'price' => fake()->name(),
                'image' => fake()->randomDigit(2),
                'visibility' => true,
                'restaurant_id' => auth()->id(),
            ]);
        }
    }
}
