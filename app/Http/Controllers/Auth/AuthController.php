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
     * Login user
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
