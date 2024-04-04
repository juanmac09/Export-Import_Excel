<?php

namespace App\Interfaces;

interface IAuth
{
    public function login(array $userData);
    public function create_token();
    public function logOut();
}
