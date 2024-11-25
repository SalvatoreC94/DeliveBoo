<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\{
    Restaurant, User
};


class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Restaurant::truncate();
        Schema::enableForeignKeyConstraints();


        $restaurants = config('restaurants');

        foreach ($restaurants as $singleRestaurant) {
            $restaurant = new Restaurant();
            $restaurant->name = $singleRestaurant['name'];
            $restaurant->address = $singleRestaurant['address'];
            $restaurant->partita_iva = $singleRestaurant['partita_iva'];
            $restaurant->image = $singleRestaurant['image'];
            // Ottieni il primo utente disponibile
            $user = User::first();

            // Associa il ristorante all'utente
            if ($user) {
                $restaurant->user_id = $user->id;
                $user->restaurant_id = $restaurant->id;
                $user->save();
            }

            $restaurant->save();
        };
    }
}
