<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\Dish;
use App\Models\Restaurant;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Dish::truncate();
        });

        for ($i = 0; $i < 10; $i++) {

            Dish::create([
                'name' => fake()->word(), // Nome semplice
                'description' => fake()->sentence(), // Frase descrittiva
                'price' => fake()->randomFloat(2, 5, 50), // Prezzo casuale tra 5 e 50 con 2 decimali
                'image' => fake()->imageUrl(640, 480, 'food', true), // URL di un'immagine fittizia
                'visibility' => true, // Sempre visibile
                'restaurant_id' => Restaurant::inRandomOrder()->first()->id, // Associa a un ristorante esistente
            ]);
        }
    }
}
