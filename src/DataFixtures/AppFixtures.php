<?php

namespace App\DataFixtures;

use App\Entity\Secret;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setAuthenticationToken("631b5763b1dea5c6cc4da351360be1576c7bc6a66a08cbd6b0f4e9fcf4e59053");
        $user->setWrappedVaultKey("2k0ZtfsvphS4UM5EbTVHHAaktjW68gDZOWxfxAlXUxLc70ukCPxOhA==");
        $user->setIsRegistered(true);
        $manager->persist($user);


        $secret = new Secret();
        $secret->setName("RBJtcxcfzxYcIxUBNOgTNQSYziYIy14u5CzEH86N/svBlg==");
        $secret->setUrl("kLE03SLE0xotlhwbghfpA02c8vnq9bxGlsEUUVix434kCDlSZcY=");
        $secret->setSecretKey("M8CSLsbYqta5C/93w5xEVpWjeek/hjuVaax9uFRqdp02c2aOq5rHujzqkf0FLoHZ0Q==");
        $secret->setUser($user);
        $manager->persist($secret);

        $secret = new Secret();
        $secret->setName("6jtsXkebcZFQCP7dEkZux0Tm0w2uDVwUPDYPPkyEJG2AxN89");
        $secret->setUrl("jzsG6W8/yf4nijpqMpKFZ1Vvl+3bEOhCmDGaSMEsE0rU86iHnlpeDg==");
        $secret->setSecretKey("M8CSLsbYqta5C/93w5xEVpWjeek/hjuVaax9uFRqdp02c2aOq5rHujzqkf0FLoHZ0Q==");
        $secret->setUser($user);
        $manager->persist($secret);

        $manager->flush();
    }
}
