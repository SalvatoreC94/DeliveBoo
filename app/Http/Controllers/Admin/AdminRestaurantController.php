<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Order;

class AdminRestaurantController extends Controller
{
    // Metodo per visualizzare gli ordini di un ristorante
    public function showOrders(Restaurant $restaurant)
    {
        $orders = $restaurant->orders()->orderBy('created_at', 'desc')->get();
        // Modifica il percorso della vista per puntare a 'orders/orders.blade.php'
        return view('orders.orders', compact('restaurant', 'orders'));
    }
    public function showOrder(Order $order)
    {
        // Carica l'ordine con i piatti associati, incluse le informazioni nella tabella pivot
        $order->load('dishes');

        // Restituisci la vista con i dettagli dell'ordine
        return view('orders.show', compact('order'));
    }
}

