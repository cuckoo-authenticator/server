<?php

namespace App\Repository;

use App\Entity\Account;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    /**
     * Saves account to the database
     *
     * @param Account $account
     * @return void
     */
    public function save(Account $account)
    {
        $this->_em->persist($account);
        $this->_em->flush();
    }

    /**
     * @param Account $account
     * Deletes the record from the database
     */
    public function delete(Account $account)
    {
        $this->_em->remove($account);
        $this->_em->flush();
    }
}
