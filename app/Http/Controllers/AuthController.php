<?php

namespace App\Http\Controllers;

use App\DTOs\User\UserRegistrationDto;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\User\Auth\UserRegistrationScenario;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RuntimeException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWTGuard;

class AuthController extends Controller
{
    public function __construct(
        private UserRegistrationScenario $scenario,

    )
    {
    }

    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $dto = UserRegistrationDto::from($request->validated())->hashPassword();
        $userData = $this->scenario->handle($dto);
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'token' => $token,
            'user' => $user,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $guard = Auth('api');
        if (! $guard instanceof JWTGuard) {
            throw new RuntimeException('Wrong guard returned.');
        }

        return response()->json([
            'token' => $token,
            'expires_in' => $guard->factory()->getTTL() * 60,
        ]);
    }

    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getUser(): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function updateUser(Request $request): JsonResponse
    {
        $user = Auth::user();
        $user->update($request->only(['name', 'email']));
        return response()->json($user);
    }
}
