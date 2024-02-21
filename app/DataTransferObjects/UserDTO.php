<?php

namespace App\DataTransferObjects;

use App\Enums\UserRole;
use Illuminate\Http\Request;

class UserDTO
{
    function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $name,
        public readonly string $surname,
        public readonly ?UserRole $role
    ) {}

    public static function fromRequest(Request $request)
    {
        return new self(
            email: $request->email,
            password: $request->password,
            name: $request->name,
            surname: $request->surname,
            role: $request->has('role') ? $request->role : null
        );
    }
}