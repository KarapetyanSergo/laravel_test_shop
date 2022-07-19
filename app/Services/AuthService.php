<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data): array
    {
        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'type' => $data['type'],
            'password' => Hash::make($data['password'])
        ]);

        return [
            'message' => 'You have successfully register!'
        ];
    }

    public function login(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'Incorrect email or password'
            ]);
        }

        $token = $user->createToken('Token Name')->accessToken;

        return [
            'message' => 'You have successfully register!',
            'token' => $token
        ];
    }

    public function logOut(Request $request)
    {
        $request->user()->token()->delete();

        return response()->json([
            'message' => 'You have successfully logout!'
        ]);
    }
}