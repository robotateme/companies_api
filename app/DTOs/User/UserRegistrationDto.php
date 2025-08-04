<?php

namespace App\DTOs\User;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;

class UserRegistrationDto extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}

    /**
     * @return $this
     */
    public function hashPassword(): static {
        $this->password = Hash::make($this->password);
        return $this;
    }
}
