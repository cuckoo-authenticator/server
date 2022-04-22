<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\Security\RegisterNewAccount;
use App\Service\Security\RequestNewAccount;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/security/request-new-account/", name="request_new_account", methods={ "POST" })
     * @param RequestNewAccount $requestNewAccount
     * @return JsonResponse
     */
    public function requestNewAccount(RequestNewAccount $requestNewAccount): JsonResponse
    {
        $user = $requestNewAccount->do();

        return new JsonResponse([
            'accountId' => $user->getId(),
            'csrfProtectionToken' => base64_encode($user->getRegistrationRequest()->getCsrfProtectionToken()),
        ], Response::HTTP_OK);
    }

    /**
     * @Route("/api/security/register-new-account/", name="regiser_new_account", methods={ "POST" })
     * @param Request $request
     * @param UserRepository $userRepository
     * @param RegisterNewAccount $registerNewAccount
     * @return JsonResponse
     */
    public function registerNewAccount(Request $request, UserRepository $userRepository, RegisterNewAccount $registerNewAccount): JsonResponse
    {
        if (! $user = $userRepository->find($request->request->get('accountId')) ) {
            return new JsonResponse([
                'error' => 'User not found',
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($user->getRegistrationRequest()->getCsrfProtectionToken() === base64_decode($request->request->get('csrfProtectionToken'))) {

            $user = $registerNewAccount->do($user, base64_decode($request->headers->get('Authentication-Token')));

            return new JsonResponse([], Response::HTTP_OK);
        }

        return new JsonResponse([
            'error' => 'Unable to register a user - unknown error',
        ], Response::HTTP_BAD_REQUEST);
    }
}
