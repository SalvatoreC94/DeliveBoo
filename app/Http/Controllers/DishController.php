<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $restaurant = $user->restaurant;

        if (!$restaurant) {
            return redirect()->route('home')->with('error', 'Non hai un ristorante associato.');
        }

        $dishes = Dish::where('restaurant_id', $restaurant->id)->get();

        return view('dishes.index', compact('dishes'));
    }

    public function create()
    {
        return view('dishes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visibility' => 'required|boolean',
        ]);

        $restaurant = auth()->user()->restaurant;

        if (!$restaurant) {
            return redirect()->route('home')->with('error', 'Non hai un ristorante associato.');
        }

        $imagePath = $this->handleImageUpload($request);

        Dish::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'visibility' => $request->visibility,
            'restaurant_id' => $restaurant->id,
        ]);

        return redirect()->route('dishes.index')->with('success', 'Piatto creato con successo!');
    }

    public function show(Dish $dish)
    {
        $this->authorizeDish($dish);

        return view('dishes.show', compact('dish'));
    }

    public function edit(Dish $dish)
    {
        $this->authorizeDish($dish);

        return view('dishes.edit', compact('dish'));
    }

    public function update(Request $request, Dish $dish)
    {
        $this->authorizeDish($dish);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visibility' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($dish->image) {
                Storage::disk('public')->delete($dish->image);
            }
            $dish->image = $this->handleImageUpload($request);
        }

        $dish->update($request->only('name', 'description', 'price', 'visibility'));

        return redirect()->route('dishes.index')->with('success', 'Piatto aggiornato con successo!');
    }

    public function destroy(Dish $dish)
    {
        $this->authorizeDish($dish);

        if ($dish->image) {
            Storage::disk('public')->delete($dish->image);
        }

        $dish->delete();

        return redirect()->route('dishes.index')->with('success', 'Piatto eliminato con successo!');
    }

    // Funzione privata per gestire l'upload dell'immagine
    private function handleImageUpload(Request $request)
    {
        return $request->file('image') ? $request->file('image')->store('dishes', 'public') : null;
    }

    // Funzione privata per autorizzare l'accesso ai piatti
    private function authorizeDish(Dish $dish)
    {
        if ($dish->restaurant_id !== auth()->user()->restaurant->id) {
            abort(403, 'Non sei autorizzato ad accedere a questo piatto.');
        }
    }
}
