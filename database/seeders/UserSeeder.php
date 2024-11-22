<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints( function() {
            User::truncate();
        });

        for ($i=0; $i< 10; $i++) { 
            
            User::create([
                'user_id' => auth()->id(),
                'name' => fake()->name(),
                'address' => fake()->sentence(),
                'partita_iva' => fake()->randomDigit(),
                'image' => fake()->sentence()
            ]);
        }
    }
}
