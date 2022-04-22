<?php

namespace App\Repository;

use App\Entity\UserRegistrationRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRegistrationRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserRegistrationRequest::class);
    }

    public function save(UserRegistrationRequest $userRegistrationRequest)
    {
        $this->_em->persist($userRegistrationRequest);
        $this->_em->flush();
    }
}