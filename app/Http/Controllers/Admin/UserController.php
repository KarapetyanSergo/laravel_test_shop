<?php

namespace App\Http\Controllers\Admin;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, UserFilter $filter): JsonResponse
    {
        $filters = json_decode($request->getContent(), true);

        $response = $filter->filtration($filters, User::query())->get();

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
