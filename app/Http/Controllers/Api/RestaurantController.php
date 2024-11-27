<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        // Recupera tutti i ristoranti con i loro piatti
        $restaurants = Restaurant::with(['dishes'])->get();

        return response()->json($restaurants);
    }
}
