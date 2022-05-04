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
        $user->setAuthenticationToken("631b5763b1dea5c6cc4da351360be1576c7bc6a66a08cbd6b0f4e9fcf4e59053");
        $user->setWrappedVaultKey("2k0ZtfsvphS4UM5EbTVHHAaktjW68gDZOWxfxAlXUxLc70ukCPxOhA==");
        $user->setIsRegistered(true);
        $manager->persist($user);


        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("Google GMail");
        $account->setUrl("gmail.com");
        $account->setSecretKey("M8CSLsbYqta5C/93w5xEVpWjeek/hjuVaax9uFRqdp02c2aOq5rHujzqkf0FLoHZ0Q==");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("Facebook");
        $account->setUrl("facebook.com");
        $account->setSecretKey("M8CSLsbYqta5C/93w5xEVpWjeek/hjuVaax9uFRqdp02c2aOq5rHujzqkf0FLoHZ0Q==");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("LinkedIn");
        $account->setUrl("linkedin.com");
        $account->setSecretKey("M8CSLsbYqta5C/93w5xEVpWjeek/hjuVaax9uFRqdp02c2aOq5rHujzqkf0FLoHZ0Q==");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("Twitter");
        $account->setUrl("twitter.com");
        $account->setSecretKey("M8CSLsbYqta5C/93w5xEVpWjeek/hjuVaax9uFRqdp02c2aOq5rHujzqkf0FLoHZ0Q==");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("Revenue");
        $account->setUrl("revenue.ie");
        $account->setSecretKey("M8CSLsbYqta5C/93w5xEVpWjeek/hjuVaax9uFRqdp02c2aOq5rHujzqkf0FLoHZ0Q==");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("MTU");
        $account->setUrl("mtu.ie");
        $account->setSecretKey("M8CSLsbYqta5C/93w5xEVpWjeek/hjuVaax9uFRqdp02c2aOq5rHujzqkf0FLoHZ0Q==");
        $account->setUser($user);
        $manager->persist($account);

        $account = new Account();
        $account->setId(Uuid::v4());
        $account->setName("Binance");
        $account->setUrl("binance.com");
        $account->setSecretKey("M8CSLsbYqta5C/93w5xEVpWjeek/hjuVaax9uFRqdp02c2aOq5rHujzqkf0FLoHZ0Q==");
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
