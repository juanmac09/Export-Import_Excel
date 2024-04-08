<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\IUser;
/**
 * @OA\Info(
 *     title="Excel export api",
 *     version="1.0",
 *     description="API to export and import excel with user information"
 * )
 */
class UserController extends Controller
{
    public $userService;

    public function __construct(IUser $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Retrieve all users.
     *
     * @OA\Get(
     *     path="/api/users/get/all",
     *     summary="Retrieve all users",
     *     security={{"bearerAuth": {}}},
     *     tags={"User"},
     * 
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *        
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Error occurred while processing the request")
     *         )
     *     )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersAll()
    {
        try {
            $users = $this->userService->getUsersAll();
            return response()->json(['users' => $users], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error occurred while processing the request'], 500);
        }
    }
}
