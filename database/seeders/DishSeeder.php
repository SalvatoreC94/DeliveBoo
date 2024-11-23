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
        Dish::truncate();
        
        $dishes = config('dishes');

        foreach($dishes as $singleDish){
            $dish = new Dish();
            $dish->name = $singleDish['name'];
            $dish->description = $singleDish['description'];
            $dish->price = $singleDish['price'];
            $dish->image = $singleDish['image'];
            $dish->visibility = $singleDish['visibility'];
            $dish->restaurant_id = $singleDish['restaurant_id'];
            $dish->save();
        }
    }
}
