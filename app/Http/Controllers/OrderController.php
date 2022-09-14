<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Services\PlaceToPayService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public PlaceToPayService $service;

    public function __construct(PlaceToPayService $service)
    {
        $this->service = $service;
    }

    public function store(OrderRequest $request): JsonResponse
    {
        $response = $this->service->createSession($request->validated(), $request->user());

        return response()->json($response, 201);
    }
}
