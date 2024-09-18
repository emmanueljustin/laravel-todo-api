<?php

namespace App\Http\Controllers;

use Hash;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Auth;
use App\Http\Requests\RegisterRequest;

class AuthenticationController extends Controller
{
    protected $authService;

    /**
     * Constructor for [AuthenticationController] class that initializes the [AuthService] class.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * A function that creates a record for the user.
     */
    public function register(Request $request): JsonResponse
    {
        $fields = $request->validate([
            "name" => "required|max:255",
            "email" => "required|email|unique:authentication,email",
            "password" => "required|string"
        ]);

        $user = $this->authService->register($fields);

        $token = $user->createToken($request->email);

        return response()->json([
            "status" => "ok",
            "message" => "Account has been succcesfully created.",
            "user_token" => $token->plainTextToken,
            "user_data" => $user
        ]);        
    }

    /**
     * A function signs in the user.
     */
    public function login(Request $request): JsonResponse
    {
        $fields = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = $this->authService->login($fields);

        if (!$user || !Hash::check($fields["password"], $user->password)) {
            return response()->json([
                "status" => "err",
                "message" => "The provided user credential are incorrect"
            ]);
        }
 
        $token = $user->createToken($user->name);

        return response()->json([
            "status" => "ok",
            "message" => "You have succesfully logged in",
            "user_token" => $token->plainTextToken,
            "user_data" => $user
        ]);
    }

    /**
     * A funtion that will logout the user and reoves it's current session.
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();
        
        return response()->json([
            "status" => "ok",
            "message" => "Logged out.",
        ]);
    }
}
