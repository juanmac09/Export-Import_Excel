<?php

namespace App\Services;

use App\Interfaces\IAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements IAuth
{
    public $user;

    /**
     * Attempts to log the user in.
     *
     * This method attempts to log the user in by searching for a user with the provided email and password.
     * If the user is found and the password matches, the user object is stored in the service instance and true is returned.
     * Otherwise, false is returned.
     *
     * @param array $userData An associative array containing the user's email and password.
     * @return bool True if the user is successfully logged in, false otherwise.
     */
    public function login(array $userData)
    {
        $user = User::where('email', $userData['email'])->first();

        if (!$user || !Hash::check($userData['password'], $user->password)) {
            return false;
        }

        $this->user = $user;
        return true;
    }

    /**
     * Generates a token for the authenticated user.
     *
     * This method creates a new token for the authenticated user and returns its plain text representation.
     *
     * @return string The plain text representation of the newly created token.
     */
    public function create_token()
    {
        return $this->user->createToken('Authorization')->plainTextToken;
    }

    /**
     * Logs the user out.
     *
     * This method will delete all tokens associated with the authenticated user.
     *
     * @return void
     */
    public function logOut()
    {
        Auth::user()->tokens()->delete();
    }
}
