<?php

namespace App\DataTransferObjects;
use App\Http\Requests\CreateTokenRequest;

class AuthDTO
{
    function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}

    public static function fromRequest(CreateTokenRequest $request)
    {
        return new self(
            email: $request->email,
            password: $request->password
        );
    }
}