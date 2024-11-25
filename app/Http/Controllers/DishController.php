<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//Models
use App\Models\Dish;
use App\Models\Restaurant;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dishes = Dish::get();

        return view('dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|string',
            'visibility' => 'nullable|string',
        ]);

        // Associa l'utente autenticato
        $newDish = new Dish($request->all());
        // $newDish->Storage::put('uploads', $newDish['image']);
        $newDish->restaurant_id = auth()->id();
        $newDish->save();

        
        // $data = $request->all();
        // $newDish = new Dish;
        // $newDish->name = $data['name'];
        // $newDish->description = $data['description'];
        // $newDish->price = $data['price'];
        // $newDish->image = $data['image'];
        // $newDish->save();

        return redirect()->route('dishes.show', $newDish->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        return view('dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        return view('dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        $data = $request->all();

        if (isset($data['image'])) {
            $data = $request->all();
        
            $newDish = new Dish;
            $newDish->image = Storage::put('uploads', $data['image']);
            // $newDish->image = Storage::disk('public')->put('uploads', $data['image']);
            
            $newDish = new Dish($request->all());
            $newDish->restaurant_id = auth()->id();
            $newDish->save();

            if($dish->image) {
                Storage::delete($dish->image);
                $dish->image = null;
            }
            // $newdish->image = Storage::put('uploads', $data['image']);
            // $newdish->save();
        }

        $dish->update($data);

        return redirect()->route('dishes.show', $dish->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();

        return redirect()->route('dishes.index');
    }
}
