<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\IUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userService;


    public function __construct(IUser $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersAll()
    {
        try {
            $users = $this->userService->getUsersAll();
            return response()->json(['users' => $users], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'error'], 500);
        }
    }
}
