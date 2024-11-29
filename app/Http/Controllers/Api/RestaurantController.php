<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        // Recupera tutti i ristoranti con i loro piatti
        $restaurants = Restaurant::with(['dishes'])->get();

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
    public function filterByCategory(Request $request)
    {
        $category_id = $request->query('category_id');

        if (!$category_id) {
            return response()->json(['error' => 'Il parametro category_id è richiesto'], 400);
        }

        // Logica di filtro
        $restaurants = Restaurant::whereHas('categories', function ($query) use ($category_id) {
            $query->where('categories.id', $category_id); // Specifica esplicitamente la tabella
        })->with('categories')->get();

        if ($restaurants->isEmpty()) {
            return response()->json(['error' => 'Nessun ristorante trovato per questa categoria'], 404);
        }

        return response()->json($restaurants);
    }



}
