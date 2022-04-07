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
        $response = $service->get($request->all())->get();

        return response()->json($response);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'message' => 'User delete success!'
        ]);
    }
}
