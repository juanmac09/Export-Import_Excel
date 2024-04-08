<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Interfaces\IAuth;

class AuthController extends Controller
{
    protected IAuth $authServices;
    public function __construct(IAuth $authServices)
    {
        $this->authServices = $authServices;
    }

    /**
     * Log in user.
     *
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Log in user",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User credentials",
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Authenticated"),
     *             @OA\Property(property="_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZjODc3Y2Nm...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The provided credentials are incorrect.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Internal server error.")
     *         )
     *     )
     * )
     *
     * @param AuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request)
    {

        try {

            if (!$this->authServices->login($request->all())) {
                return response()->json(['message' => 'The provided credentials are incorrect.'], 401);
            }
            return response()->json(['message' => 'Authenticated'], 200, ['_token' => $this->authServices->create_token()]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'error'], 500);
        }
    }


    /**
     * Logs out the user.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function logOut()
    {
        try {
            $this->authServices->logOut();
            return response()->json(['message' => 'Successfully Closed Session'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'error'], 500);
        }
    }
}
