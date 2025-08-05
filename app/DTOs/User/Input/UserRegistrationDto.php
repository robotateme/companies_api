<?php

namespace App\DTOs\User\Input;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;

/**
 * @class UserRegistrationDto
 * @package App\DTOs\User
 * @OA\Schema(
 *     title="User registtration",
 *     description="Регистрация пользователя",
 *     schema="UserRegister",
 *     required={"name", "email", "password"},
 * )
 */
class UserRegistrationDto extends Data
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        /**
         * @var string $name
         * @OA\Property (format="string", title="name", property="name", example="John Doe")
         */
        public string $name,
        /**
         * @var string $emqil
         * @OA\Property (format="string", title="email", property="email", example="test@example.com")
         */
        public string $email,
        /**
         * @var string $password
         * @OA\Property (format="string", title="password", property="password", example="password")
         */
        public string $password,
    )
    {
    }

    /**
     * @return $this
     */
    public function hashPassword(): static
    {
        $this->password = Hash::make($this->password);
        return $this;
    }
}
