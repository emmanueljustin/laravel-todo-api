<?php

namespace App\Services;

use App\Models\Auth;
use App\Repositories\AuthRepository\AuthRepository;

class AuthService
{
    protected $repo;

    /**
     * Constructor for class [AuthService].
     */
    public function __construct(AuthRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Function that calls for the register method of [AuthService] class.
     */
    public function register(array $data) : Auth
    {
        return $this->repo->register($data);
    }

    /**
     * Function that calls for the login method of [AuthService] class.
     */
    public function login(array $data) : Auth
    {
        return $this->repo->login($data);
    }

    /**
     * Function that calls for the logout method of [AuthService] class.
     */
    public function logout() : bool
    {
        return $this->repo->logout();
    }
}
