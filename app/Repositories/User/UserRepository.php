<?php

namespace App\Repositories\User;

use App\DTOs\User\Input\UserRegistrationDto;
use App\Repositories\Contracts\AbstractRepository;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * @param UserRegistrationDto $data
     * @return iterable
     */
    public function createUser(UserRegistrationDto $data): iterable
    {
        $user = $this->getBuilder()->create($data->toArray());
        return [
            'user' => $user->toArray(),
            'token' => JWTAuth::fromUser($user),
        ];
    }
}
