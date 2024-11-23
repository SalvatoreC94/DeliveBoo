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

        $restaurants = config('restaurants');

        foreach($restaurants as $singleRestaurant){
            $restaurant = new Restaurant();
            $restaurant->name = $singleRestaurant['name'];
            $restaurant->address = $singleRestaurant['address'];
            $restaurant->partita_iva = $singleRestaurant['partita_iva'];
            $restaurant->image = $singleRestaurant['image'];
            $restaurant->save();
        }
    }
}
