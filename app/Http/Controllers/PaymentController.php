<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;
use App\Models\Order;
use App\Models\OrderedRequest;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => config('braintree.environment'),
            'merchantId' => config('braintree.merchantId'),
            'publicKey' => config('braintree.publicKey'),
            'privateKey' => config('braintree.privateKey'),
        ]);
    }

    public function getClientToken()
    {
        $clientToken = $this->gateway->clientToken()->generate();
        dd($clientToken); // Debug: mostriamo il clientToken
        return response()->json(['clientToken' => $clientToken]);
    }

    public function processPayment(Request $request)
    {
        $amount = $request->input('amount'); // Importo passato dal client
        $nonce = $request->input('nonce'); // Token di pagamento

        // Dati dell'utente
        $name = $request->input('name');
        $email = $request->input('email');
        $telephone = $request->input('telephone');

        // Verifica che l'importo sia valido
        if ($amount <= 0) {
            return response()->json(['success' => false, 'message' => 'Importo non valido']);
        }

        // Effettua la transazione
        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);

        if ($result->success) {
            // Creazione dell'ordine
            $order = Order::create([
                'name' => $name,
                'email' => $email,
                'telephone' => $telephone,
                'total_price' => $amount,
                'restaurant_id' => 1, // Puoi passare il ristorante selezionato dal frontend
            ]);

            // Aggiorna la tabella ordered_request
            foreach ($request->input('cart') as $item) {
                OrderedRequest::create([
                    'order_id' => $order->id,
                    'dish_id' => $item['id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            return response()->json(['success' => true, 'transactionId' => $result->transaction->id]);
        } else {
            return response()->json(['success' => false, 'message' => $result->message]);
        }
    }
}
