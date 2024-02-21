<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\AuthDTO;
use App\Http\Requests\CreateTokenRequest;
use App\Services\AuthService;


class AuthController extends Controller
{
    function __construct(
        public AuthService $authService = new AuthService()
    ) {}

    public function createToken(CreateTokenRequest $request)
    {
        $token = $this->authService->createToken(
            AuthDTO::fromRequest($request),
            $request->header('User-Agent')
        );
     
        return [
            'token' => $token->plainTextToken
        ];
    }
}
