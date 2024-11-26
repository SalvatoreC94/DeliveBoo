<?php
namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

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
        return view('dishes.edit', compact('dish'));
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

        return redirect()->route('dishes.index')->with('success', 'Piatto aggiornato con successo!');
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();

        return redirect()->route('dishes.index')->with('success', 'Piatto eliminato con successo!');
    }
}
