<?php

namespace App\Service\Security;

use App\Entity\User;
use App\Entity\UserRegistrationRequest;
use App\Repository\UserRegistrationRequestRepository;
use App\Repository\UserRepository;

class RequestNewAccount
{
    private UserRepository $userRepository;
    private UserRegistrationRequestRepository $userRegistrationRequestRepository;

    public function __construct(UserRepository $userRepository, UserRegistrationRequestRepository $userRegistrationRequestRepository)
    {
        $this->userRepository = $userRepository;
        $this->userRegistrationRequestRepository = $userRegistrationRequestRepository;
    }

    public function do(): User
    {
        $user = new User();
        $this->userRepository->save($user);

        $userRegistrationRequest = new UserRegistrationRequest();
        $userRegistrationRequest->setUser($user);
        $this->userRegistrationRequestRepository->save($userRegistrationRequest);

        $user->setRegistrationRequest($userRegistrationRequest);
        $this->userRepository->save($user);

        return $user;
    }
}