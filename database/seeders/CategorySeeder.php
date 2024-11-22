<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints( function() {
            Category::truncate();
        });

        for ($i=0; $i< 10; $i++) { 
            
            Category::create([
                'name' => fake()->sentence(),
            ]);
        }
    }
}
