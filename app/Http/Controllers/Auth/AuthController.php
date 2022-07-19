<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, AuthService $authService): JsonResponse
    {
        return response()->json($this->getDataResponse($authService->register($request->all())));
    }

    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        return response()->json($this->getDataResponse($authService->login($request->all())));
    }

    public function logOut(Request $request, AuthService $authService): JsonResponse
    {
        return response()->json($this->getDataREsponse($authService->logOut($request)));
    }
}
