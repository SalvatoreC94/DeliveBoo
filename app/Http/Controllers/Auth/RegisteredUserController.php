<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Show the registration form (alias for create).
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return $this->showRegistrationForm();
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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
            'partita_iva' => 'required|digits:11',
            'cuisine_type' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Creazione dell'utente
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Creazione del ristorante associato all'utente
        $restaurant = new Restaurant([
            'name' => $request->restaurant_name,
            'address' => $request->address,
            'partita_iva' => $request->partita_iva,
            'image' => $request->hasFile('image') ? $request->file('image')->store('restaurants', 'public') : null,
        ]);
        $user->restaurant()->save($restaurant);

        // Associa la tipologia di cucina
        $restaurant->categories()->attach($request->cuisine_type);

        // Effettua il login dell'utente
        Auth::login($user);

        // Aggiungi il flash message
        $request->session()->flash('success', 'Utente registrato con successo!');

        // Redireziona alla dashboard del ristorante
        return redirect()->route('restaurant.dashboard');
    }
}
