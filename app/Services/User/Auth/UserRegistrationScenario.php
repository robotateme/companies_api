<?php

namespace App\Services\User\Auth;

use App\DTOs\User\Input\UserRegistrationDto;
use App\Models\User;
use App\Repositories\User\UserRepository;

class UserRegistrationScenario
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    /**
     * @param UserRegistrationDto $dto
     * @return iterable
     */
    public function handle(UserRegistrationDto $dto): iterable
    {
        /** @var User $user */
        return $this->userRepository->createUser($dto);
    }
}
