<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        User::create([
            'name'  =>  $request->name,
            'email' =>  $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'You have successfully register!'
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'Incorrect email or password'
            ]);
        }

        $token = $user->createToken('Token Name')->accessToken;

        return response()->json([
            'message' => 'You have successfully login!',
            'token' => $token
        ]);
    }

    public function logOut(Request $request): JsonResponse
    {
        $request->user()->token()->delete();

        return response()->json([
            'message' => 'You have successfully logout!'
        ]);
    }
}
