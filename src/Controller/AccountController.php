<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/api/secret/", name="secrets_get", methods={ "GET" })
     * @return JsonResponse
     */
    public function secrets(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        $secrets = array();

        foreach ($user->getSecrets() as $secret) {
             $secrets[] = array(
                 'id' => $secret->getId(),
                 'name' => $secret->getName(),
                 'url' => $secret->getUrl(),
                 'secretKey' => $secret->getSecretKey(),
             );
        }


        return new JsonResponse($secrets, Response::HTTP_OK);
    }
}