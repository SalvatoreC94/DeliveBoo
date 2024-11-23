<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Dish;
use App\Models\Restaurant;

class DishSeeder extends Seeder
{
    public function run(): void
    {
        // Gestione sicura dei vincoli e reset dei dati
        Schema::disableForeignKeyConstraints();

        // Svuota prima la tabella dipendente
        DB::table('ordered_request')->truncate();

        // Svuota la tabella dishes
        Dish::truncate();

        Schema::enableForeignKeyConstraints();

        // Dati dei piatti
        $dishes = config('dishes');

        foreach ($dishes as $singleDish) {
            Dish::create([
                'name' => $singleDish['name'],
                'description' => $singleDish['description'],
                'price' => $singleDish['price'],
                'image' => $singleDish['image'],
                'visibility' => $singleDish['visibility'],
                'restaurant_id' => Restaurant::inRandomOrder()->first()->id,
            ]);
        }
    }
}

