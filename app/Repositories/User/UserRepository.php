<?php

namespace App\Repositories\User;

use App\DTOs\User\UserRegistrationDto;
use App\Repositories\Contracts\AbstractRepository;
use App\Repositories\User\Contracts\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * @param UserRegistrationDto $data
     * @return iterable
     */
    public function createUser(UserRegistrationDto $data): iterable
    {

    }
}
