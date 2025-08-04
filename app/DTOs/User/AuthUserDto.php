<?php

namespace App\DTOs\User;

use Spatie\LaravelData\Data;

class AuthUserDto extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $token,
    ) {}
}
