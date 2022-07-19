<?php

namespace App\Http\Controllers\Admin;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, UserService $service): JsonResponse
    {
        return response()->json($this->getDataREsponse($service->get($request->all())));
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($this->getDataResponse($user));
    }

    public function destroy(User $user, UserService $service): JsonResponse
    {
        return response()->json($this->getDataResponse($service->delete($user)));
    }
}
