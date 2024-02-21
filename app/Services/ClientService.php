<?php

namespace App\Services;

use App\DataTransferObjects\UserDTO;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClientService
{
    public function store(UserDTO $userDTO)
    {
        return User::create([
            'name' => $userDTO->name,
            'surname' => $userDTO->surname,
            'email' => $userDTO->email,
            'password' => Hash::make($userDTO->password),
            'role' => UserRole::CLIENT
        ]);
    }
}