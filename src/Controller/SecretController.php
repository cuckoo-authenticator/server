<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\SecretRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecretController extends AbstractController
{
    /**
     * @Route("/api/secret/", name="secret_post", methods={ "GET" })
     * @param SecretRepository $secretRepository
     * @return JsonResponse
     */
    public function secret(SecretRepository $secretRepository): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        $secrets = array();

        foreach ($user->getSecrets() as $secret) {
             $secrets[] = array(
                 'ulid' => $secret->getId(),
                 'name' => $secret->getName(),
                 'url' => $secret->getUrl(),
                 'secretKey' => $secret->getSecretKey(),
             );
        }


        return new JsonResponse($secrets, Response::HTTP_OK);
    }
}