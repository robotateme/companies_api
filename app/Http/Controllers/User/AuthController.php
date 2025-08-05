<?php

namespace App\Http\Controllers\User;

use App\DTOs\User\Input\UserRegistrationDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\User\Auth\UserRegistrationScenario;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWTGuard;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserRegistrationScenario $scenario,

    )
    {
    }

    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     * @OA\Post(
     *      path="/api/register",
     *      summary="User registtration",
     *      tags={"Authetication"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/UserRegister"),
     *      ),
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      )
     * )
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $dto = UserRegistrationDto::from($request->validated())->hashPassword();
        return new JsonResponse([
            'data' => $this->scenario->handle($dto),
        ], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @OA\Post(
     *      path="/api/login",
     *      summary="User login",
     *      tags={"Authetication"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *           @OA\Schema(
     *               @OA\Property (format="string", title="email", property="email", example="test@example.com"),
     *               @OA\Property (format="string", title="password", property="password", example="password")
     *          )
     *      ),
     * ),
     * @OA\Response(
     *         response=200,
     *        description="OK"
     *     )
     * )
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return new JsonResponse(['error' => 'Invalid credentials'], 401);
        }

        $guard = Auth('api');
        if (!$guard instanceof JWTGuard) {
            throw new RuntimeException('Wrong guard returned.');
        }

        return new JsonResponse([
            'data' => [
                'token' => $token,
                'expires_in' => $guard->factory()->getTTL() * 60,
            ]
        ]);
    }

    public function logout(): JsonResponse
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $exception) {
            return new JsonResponse(['error' => $exception->getMessage()], 401);
        }

        return new JsonResponse(['message' => 'Successfully logged out']);
    }

    public function getUser(): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return new JsonResponse(['error' => '401 Unauthorized'], 401);
        }
        return new JsonResponse($user);
    }
}
