<?php

namespace App\Services\User\Auth;

use App\DTOs\User\UserRegistrationDto;

class UserRegistrationScenario
{
    public function __construct(private UserRegistrationDto $userRegistrationDto)
    {
    }

    /**
     * @param UserRegistrationDto $dto
     * @return iterable
     */
    public function handle(UserRegistrationDto $dto): iterable
    {
        return [];
    }
}
