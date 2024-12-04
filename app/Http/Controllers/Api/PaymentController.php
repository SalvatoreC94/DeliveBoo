<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree\Gateway;
use App\Models\Order;
use App\Models\OrderedRequest;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);
    }

    // Metodo per ottenere il client token
    public function getClientToken()
    {
        $clientToken = $this->gateway->clientToken()->generate();
        return response()->json(['clientToken' => $clientToken]);
    }

    // Metodo per processare il pagamento
    public function processPayment(Request $request)
    {
        // Validazione dei dati
        $validated = $request->validate([
            'nonce' => 'required|string',
            'amount' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required|string',
            'cart' => 'required|array',
        ]);

        // Dati dalla richiesta
        $nonce = $validated['nonce'];
        $amount = $validated['amount'];
        $name = $validated['name'];
        $email = $validated['email'];
        $telephone = $validated['telephone'];
        $cart = $validated['cart'];

        // Esegui la transazione con Braintree
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => ['submitForSettlement' => true],
        ]);

        // Verifica il risultato della transazione
        if ($result->success) {
            // Crea l'ordine nel database
            $order = Order::create([
                'name' => $name,
                'email' => $email,
                'telephone' => $telephone,
                'total_price' => $amount,
                'restaurant_id' => $cart[0]['restaurant_id'], // Presume che tutti i piatti siano dello stesso ristorante
            ]);

            // Crea le righe per ogni piatto nel carrello
            foreach ($cart as $item) {
                OrderedRequest::create([
                    'order_id' => $order->id,
                    'dish_id' => $item['id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            // Risposta positiva
            return response()->json([
                'success' => true,
                'transactionId' => $result->transaction->id,
                'order' => $order // Restituisci l'ordine creato come conferma
            ]);
        } else {
            // Risposta negativa in caso di errore
            return response()->json([
                'success' => false,
                'message' => $result->message
            ], 500); // Status code 500 per errore del server
        }
    }
}
