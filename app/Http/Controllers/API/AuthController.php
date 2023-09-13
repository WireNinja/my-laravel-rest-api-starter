<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttemptLoginRequest;
use App\Http\Requests\AttemptRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function attemptLogin(AttemptLoginRequest $request)
    {
        $credentials = $request->validated();

        if (!auth()->attempt($credentials)) {
            return ResponseHelper::error(null, 'Invalid credentials', 401);
        }

        $token = $request->user()->createToken('auth_token')->plainTextToken;

        return ResponseHelper::success([
            'user' => auth()->user(),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function attemptRegister(AttemptRegisterRequest $request)
    {
        $credentials = $request->validated();

        $user = User::create($credentials);

        $token = $user->createToken('auth_token')->plainTextToken;

        return ResponseHelper::success([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function attemptLogout(Request $request)
    {
        $request->user()->tokens()->delete();

        // $request->user()->currentAccessToken()->delete();

        return ResponseHelper::success(null, 'Logged out successfully');
    }
}
