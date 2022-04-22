<?php

namespace App\Service\Security;

use App\Entity\User;
use App\Repository\UserRepository;

class RegisterNewAccount
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function do(User $user, string $authenticationToken): User
    {
        $user->setAuthenticationToken($authenticationToken);
        $user->setIsRegistered(true);
        $this->userRepository->save($user);

        return $user;
    }
}
