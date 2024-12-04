<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        // Recupera tutti i ristoranti con i loro piatti e categorie
        $restaurants = Restaurant::with(['dishes', 'categories'])->get();

        return response()->json($restaurants);
    }
    public function show($id)
    {
        $restaurant = Restaurant::with('dishes')->find($id);

        if (!$restaurant) {
            return response()->json(['error' => 'Ristorante non trovato'], 404);
        }

        return response()->json($restaurant);
    }






}
