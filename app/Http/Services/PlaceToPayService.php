<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class PlaceToPayService
{
    public function __construct()
    {
        $this->nonce = random_int(1, 120);
        $this->seed = now()->toIso8601String();
        $this->login = '6dd490faf9cb87a9862245da41170ff2';
        $this->tranKey = '024h1IlD';
    }

    public function createSession(array $data, User $user): array
    {
        $session = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://stoplight.io/mocks/placetopay-api/webcheckout-docs/10862976/api/session', [
            'auth' => [
                'login' => $this->login,
                'tranKey' => base64_encode(sha1($this->nonce . $this->seed . $this->tranKey, true)),
                'nonce' => base64_encode($this->nonce),
                'seed' => now()->toIso8601String()
            ]
        ]);

        $order = Order::create([
            ...$data,
            'request_id' => data_get($session->json(), 'requestId', 0),
            'user_id' => $user->id,
            'status' => Order::CREATED,
        ])->toArray();

        $order['url'] = data_get($session->json(), 'processUrl', []);

        return $order;
    }

    public function getSessionUrl(int $requestId): mixed
    {
        $session = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post('https://stoplight.io/mocks/placetopay-api/webcheckout-docs/10862976/api/session/' . $requestId, [
            'auth' => [
                'login' => $this->login,
                'tranKey' => base64_encode(sha1($this->nonce . $this->seed . $this->tranKey, true)),
                'nonce' => base64_encode($this->nonce),
                'seed' => now()->toIso8601String()
            ]
        ]);

        return data_get($session->json(), 'request.fields.0.value', []);
    }
}
