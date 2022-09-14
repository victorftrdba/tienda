<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @throws AuthenticationException
     */
    public function auth(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!Auth::attempt($request->only(['email', 'password']))) {
            throw new AuthenticationException('Error during authentication.');
        }

        return response()->json([
            'token' => $user->createToken($user->name)->plainTextToken
        ]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        return response()->json($user, 201);
    }

    public function orders(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = $request->user()->orders()->with('product')->orderBy('created_at', 'DESC')->get();

        return response()->json($response);
    }
}
