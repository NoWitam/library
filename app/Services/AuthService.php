<?php

namespace App\Services;

use App\DataTransferObjects\AuthDTO;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthService
{
    public function createToken(AuthDTO $authDTO, string $tokenName) : NewAccessToken
    {
        $user = User::where('email', $authDTO->email)->first();

        if (Hash::check($authDTO->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return $user->createToken($tokenName);
    }
}