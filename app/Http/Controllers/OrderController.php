<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Services\PlaceToPayService;
use App\Models\User;

class OrderController extends Controller
{
    public PlaceToPayService $service;

    public function __construct(PlaceToPayService $service)
    {
        $this->service = $service;
    }

    public function store(OrderRequest $request): \Illuminate\Http\JsonResponse
    {
        $response = $this->service->payment($request->validated(), $request->user());

        return response()->json($response, 201);
    }
}
