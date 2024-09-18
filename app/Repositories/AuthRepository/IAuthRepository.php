<?php

namespace App\Repositories\AuthRepository;

use App\Models\Auth;

interface IAuthRepository
{
    public function register(array $data) : Auth;
    public function login(array $data) : Auth;
    public function logout() : bool;
}
