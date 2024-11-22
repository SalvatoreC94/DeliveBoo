<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints( function() {
            Order::truncate();
        });

        for ($i=0; $i< 10; $i++) { 
            
            Order::create([
                // 'user_id' => auth()->id(),

                'name' => fake()->name(),
                'telephone' => fake()->sentence(),
                'email' => fake()->randomDigit(),
                'total_price' => fake()->sentence(),
                'restaurant_id' => fake()->sentence(),
            ]);
        }
    }
}
