<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    // funzione di riacquisizione account da SoftDelete
    public function create(array $input) {
        // check di utenti cancellati con soft delete
        $user = User::onlyTrashed()->where('email', $input['email'])->first();

        // Ripristina utente
        if($user){
            // Recupero utente
            $user->restore();

            // Agiorna dati se utente si registra con valori diversi
            $user->update([
                'username'=>$input['username'],
                'email'=>$input['email'],
                'password'=>Hash::make($input['password']),
                'restaurant_name'=>$input['restaurant_name'],
                'address'=>$input['address'],
                'partita_iva'=>$input['partita_iva'],
                'cuisine_type'=>$input['cuisine_type'],
                'image'=>$input['image'],
            ]);
            return $user;
        }
    }

    public function showRegistrationForm()
    {
        $categories = Category::all();
        return view('auth.register', compact('categories'));
    }

    public function store(Request $request)
    {
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

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('restaurants', 'public')
            : null;

        $restaurant = Restaurant::create([
            'name' => $request->restaurant_name,
            'address' => $request->address,
            'partita_iva' => $request->partita_iva,
            'image' => $imagePath,
            'user_id' => $user->id,
        ]);

        $restaurant->categories()->sync($request->cuisine_type);

        // Popola i piatti dal config
        $this->populateDishesFromConfig($restaurant, $request->cuisine_type);

        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Registrazione completata con successo!');
    }

    private function populateDishesFromConfig(Restaurant $restaurant, array $categoryIds)
    {
        $configDishes = config('dishes');

        $filteredDishes = array_filter($configDishes, function ($dish) use ($categoryIds) {
            return in_array($dish['category_id'], $categoryIds);
        });

        foreach ($filteredDishes as $dish) {
            Dish::create([
                'name' => $dish['name'],
                'description' => $dish['description'],
                'price' => $dish['price'],
                'image' => $dish['image'],
                'visibility' => $dish['visibility'],
                'restaurant_id' => $restaurant->id,
                'category_id' => $dish['category_id'],
            ]);
        }
    }
}
