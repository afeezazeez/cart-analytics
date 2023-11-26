<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login user
     * @throws ClientErrorException
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->validated());

        return successResponse("Login success",$data);
    }

    /**
     * Logout user
     */
    public function delete(): JsonResponse
    {
        $this->authService->logout();
        return successResponse("Logout success");
    }
}
