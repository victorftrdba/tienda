<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class PlaceToPayService
{
    public function payment(array $data, User $user): Order
    {
        $nonce = random_int(1, 120);
        $seed = now()->toIso8601String();
        $login = '6dd490faf9cb87a9862245da41170ff2';
        $tranKey = '024h1IlD';

        $session = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://stoplight.io/mocks/placetopay-api/webcheckout-docs/10862976/api/session', [
            'auth' => [
                'login' => $login,
                'tranKey' => base64_encode(sha1($nonce.$seed.$tranKey, true)),
                'nonce' => base64_encode($nonce),
                'seed' => now()->toIso8601String()
            ]
        ]);

        return Order::create([
            ...$data,
            'request_id' => $session->json()['requestId'],
            'user_id' => $user->id,
            'status' => Order::CREATED,
        ]);
    }
}
