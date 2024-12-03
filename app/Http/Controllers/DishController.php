<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $restaurant = $user->restaurant;

        if (!$restaurant) {
            return redirect()->route('home')->with('error', 'Non hai un ristorante associato.');
        }

        // $dishes = Dish::where('restaurant_id', $restaurant->id)->get();

        // Filtra in base alla richiesta
        if ($request->filter == 'trashed') {
            $dishes = Dish::onlyTrashed()->where('restaurant_id', $restaurant->id)->get();
        } elseif ($request->filter == 'all') {
            $dishes = Dish::withTrashed()->where('restaurant_id', $restaurant->id)->get();
        } else {
            $dishes = Dish::where('restaurant_id', $restaurant->id)->get();
        }

        // Conta i piatti eliminati
        $trashedCount = Dish::onlyTrashed()->where('restaurant_id', $restaurant->id)->count();
        // Conta i piatti Attivi
        $activeCount = Dish::withTrashed()->where('restaurant_id', $restaurant->id)->count();
        // Conta tutti i piatti
        $allCount = Dish::where('restaurant_id', $restaurant->id)->count();


        return view('dishes.index', compact('dishes', 'trashedCount', 'activeCount', 'allCount'));
    }

    public function create()
    {
        // return view('dishes.create', compact('dishes')); // Passa la variabile alla vista
        
        $dishes = Dish::all(); // Recupera tutti i piatti dal database
        $categories = Category::all(); // Recupera tutte le categorie
        return view('dishes.create', compact('dishes', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $restaurant = auth()->user()->restaurant;

        $imagePath = $request->file('image')
            ? $request->file('image')->store('dishes', 'public')
            : null;

        // $category = Category::all();
        Dish::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'visibility' => $request->has('visibility'),
            'category_id' => $request->category_id,
            'restaurant_id' => $restaurant->id,
        ]);

        return redirect()->route('dishes.index')->with('success', 'Piatto creato con successo!');
    }

    public function show(Dish $dish)
    {
        return view('dishes.show', compact('dish'));
    }

    public function edit(Dish $dish)
    {
        // return view('dishes.edit', compact('dish'));
        $categories = Category::all(); // Recupera tutte le categorie
        return view('dishes.edit', compact('dish', 'categories'));
    }

    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('dishes', 'public');
            $dish->image = $imagePath;
        }

        $dish->update($request->only('name', 'description', 'price', 'visibility', 'category_id'));

        return redirect()->route('dishes.show', ['dish' => $dish->id])->with('success', 'Piatto aggiornato con successo!');
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();

        return redirect()->route('dishes.index');
    }

    // Funzione per il Ripristino
    public function restore($id)
    {
        // Trova il piatto eliminato
        $dish = Dish::onlyTrashed()->findOrFail($id);
        
        // Ripristina il piatto
        $dish->restore();

        return redirect()->route('dishes.index')->with('success', 'Piatto ripristinato con successo!');
    }

    public function forceDestroy($id)
    {
        // Trova il piatto eliminato
        $dish = Dish::onlyTrashed()->findOrFail($id); 

        // Elimina definitivamente il piatto
        $dish->forceDelete(); 

        return redirect()->route('dishes.index')->with('success', 'Piatto eliminato definitivamente!');
    }
}
