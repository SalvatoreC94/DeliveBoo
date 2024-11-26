<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'visibility',
        'restaurant_id',
        'category_id',
    ];

    // Relazione molti a uno con il ristorante
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    // Relazione molti a molti con gli ordini
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'ordered_request')->withPivot('quantity');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
