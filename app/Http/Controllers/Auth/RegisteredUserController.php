<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     */
    public function store(Request $request)
    {
        // Validazione dei dati del form
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'restaurant_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'partita_iva' => 'required|digits:11|unique:restaurants,partita_iva',
            'cuisine_type' => 'required|array',
            'cuisine_type.*' => 'integer|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Creazione dell'utente
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Gestione immagine
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('restaurants', 'public')
            : null;

        // Creazione del ristorante associato all'utente
        $restaurant = new Restaurant([
            'name' => $request->restaurant_name,
            'address' => $request->address,
            'partita_iva' => $request->partita_iva,
            'image' => $imagePath,
        ]);
        $user->restaurant()->save($restaurant);

        // Associazione delle categorie
        if ($request->has('cuisine_type')) {
            $validCategories = Category::whereIn('id', $request->cuisine_type)->pluck('id')->toArray();
            $restaurant->categories()->attach($validCategories);
        }

        // Effettua il login dell'utente
        Auth::login($user);

        // Flash message di successo
        $request->session()->flash('success', 'Utente registrato con successo!');

        // Redireziona alla dashboard
        return redirect()->route('restaurant.dashboard');
    }
}
