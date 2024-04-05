<?php

namespace App\Services;

use App\Interfaces\IUser;
use App\Models\User;

class UserService implements IUser
{
    /**
     * Retrieves all users from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
    */
    public function getUsersAll()
    {
        $users = User::all();
        return $users;
    }
}
