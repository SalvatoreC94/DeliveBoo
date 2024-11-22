<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\OrderedRequest;

class OrderedRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints( function() {
            OrderedRequest::truncate();
        });

        for ($i=0; $i< 10; $i++) { 
            
            OrderedRequest::create([
                // 'user_id' => auth()->id(),

                'order_id' => fake()->sentence(),
                'dishes_id' => fake()->sentence(),
                'quantity' => fake()->randomDigit(2),
            ]);
        }
    }
}
