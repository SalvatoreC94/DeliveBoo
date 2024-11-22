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
        Schema::withoutForeignKeyConstraints( function() {
            Restaurant::truncate();
        });

        for ($i=0; $i< 10; $i++) { 
            
            Restaurant::create([
                define('email', fake()->sentence()),

                'name' => fake()->name(),
                'email' => 'email',
                'email_verified_at' => 'email',
                'password' => fake()->randomDigit(6),
            ]);
        }
    }
}
