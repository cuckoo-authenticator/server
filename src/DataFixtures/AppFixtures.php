<?php

namespace App\DataFixtures;

use App\Entity\Account;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setAuthenticationToken("cRudtDOOkvPZpZReaZFpZUYkEvKj+fDg0n5tk6FQfuk=");
        $user->setWrappedVaultKey("puebL1wK09DIv0WNZmH4Y96zZ3Pm7g3dcqwJR1YHDP4PYNgmjOK0Ng==");
        $user->setIsRegistered(true);
        $manager->persist($user);


        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("ke1wOpZ/jauU7NpuVSsA5zXW9MkQ9rKtGV8zR/ctJYTuHg==");
        $account->setUrl("k58if2M6A5X5r8qKBKTa7lMxRoJ3sVfw4YEiJcXQ9PPjEZtPGnY=");
        $account->setSecretKey("FbiNACbzm3O22+QpFNuosLwHjbWARrIXs9QXKRGgQVIwgRmuLYE=");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("ke1wOpZ/jauU7NpuVSsA5zXW9MkQ9rKtGV8zR/ctJYTuHg==");
        $account->setUrl("k58if2M6A5X5r8qKBKTa7lMxRoJ3sVfw4YEiJcXQ9PPjEZtPGnY=");
        $account->setSecretKey("FbiNACbzm3O22+QpFNuosLwHjbWARrIXs9QXKRGgQVIwgRmuLYE=");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("ke1wOpZ/jauU7NpuVSsA5zXW9MkQ9rKtGV8zR/ctJYTuHg==");
        $account->setUrl("k58if2M6A5X5r8qKBKTa7lMxRoJ3sVfw4YEiJcXQ9PPjEZtPGnY=");
        $account->setSecretKey("FbiNACbzm3O22+QpFNuosLwHjbWARrIXs9QXKRGgQVIwgRmuLYE=");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("ke1wOpZ/jauU7NpuVSsA5zXW9MkQ9rKtGV8zR/ctJYTuHg==");
        $account->setUrl("k58if2M6A5X5r8qKBKTa7lMxRoJ3sVfw4YEiJcXQ9PPjEZtPGnY=");
        $account->setSecretKey("FbiNACbzm3O22+QpFNuosLwHjbWARrIXs9QXKRGgQVIwgRmuLYE=");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("ke1wOpZ/jauU7NpuVSsA5zXW9MkQ9rKtGV8zR/ctJYTuHg==");
        $account->setUrl("k58if2M6A5X5r8qKBKTa7lMxRoJ3sVfw4YEiJcXQ9PPjEZtPGnY=");
        $account->setSecretKey("FbiNACbzm3O22+QpFNuosLwHjbWARrIXs9QXKRGgQVIwgRmuLYE=");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("ke1wOpZ/jauU7NpuVSsA5zXW9MkQ9rKtGV8zR/ctJYTuHg==");
        $account->setUrl("k58if2M6A5X5r8qKBKTa7lMxRoJ3sVfw4YEiJcXQ9PPjEZtPGnY=");
        $account->setSecretKey("FbiNACbzm3O22+QpFNuosLwHjbWARrIXs9QXKRGgQVIwgRmuLYE=");
        $account->setUser($user);
        $manager->persist($account);





        /*
        for($i = 1; $i < 100; $i++)
        {
            $account = new Account();
            $account->setId(Uuid::v4());
            $account->setName($i);
            $account->setUrl($i);
            $account->setSecretKey($i);
            $account->setUser($user);
            $manager->persist($account);
        }
        */

        $manager->flush();
    }
}
