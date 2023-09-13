<?php

namespace App\Http\Controllers\API;

use App\Helpers\QueryParamHelper as Query;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = Query::perPage($request);
        $page = Query::page($request);
        $order = Query::order($request);
        $orderBy = Query::orderBy($request);

        $users = User::query()
            ->orderBy($orderBy, $order)
            ->paginate($perPage, ['*'], 'page', $page);

        return ResponseHelper::success($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        return ResponseHelper::success($user, 'User created', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        return ResponseHelper::success($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->update($request->validated());

        return ResponseHelper::success($user, 'User updated', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return ResponseHelper::success($user, 'User deleted');
    }
}
