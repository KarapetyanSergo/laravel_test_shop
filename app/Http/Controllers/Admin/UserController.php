<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Services\FilterService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request, FilterService $filterService): JsonResponse
    {
        $filters = json_decode($request->getContent(), true);

        if (isset($filters['filters'])) {
            $response = $filterService->filtration(Collection::make($filters['filters']), new User())->get();
        } else {
            $response = User::all();
        }

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
