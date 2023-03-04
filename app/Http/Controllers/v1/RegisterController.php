<?php

namespace App\Http\Controllers\v1;


use App\Http\Controllers\Controller;
use App\Http\Model\User;
use App\Http\Validates\RegisterUserRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{

    public function register(RegisterUserRequest $request): JsonResponse
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['data' => 'ok'], 201);
    }
}
