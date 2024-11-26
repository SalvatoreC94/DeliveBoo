<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relazione One to One con restaurant (il ristoratore può gestire un solo ristorante)
    public function restaurant()
    {
        return $this->hasOne(Restaurant::class);
    }

    // Relazione uno a molti con gli ordini (il ristoratore può controllare gli ordini dei ristoranti)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
