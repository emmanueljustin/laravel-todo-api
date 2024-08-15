<?php

namespace App\Repositories\AuthRepository;

use App\Repositories\AuthRepository\IAuthRepository;
use App\Models\Auth;

class AuthRepository implements IAuthRepository
{

    /**
     * Register method for [AuthRepository] class.
     */
    public function register(array $data) : Auth
    {
        return Auth::create($data);
    }

    /**
     * Login method for [AuthRepository] class.
     */
    public function login(array $data) : Auth
    {
        return Auth::where("email", $data["email"])->first();
    }

    /**
     * Logout method for [AuthRepository] class.
     */
    public function logout() : bool
    {
        return auth('sanctum')->user()->tokens()->delete();
    }
}
