<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\User;
use App\Repository\AccountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/api/account/", name="account_get", methods={ "GET" })
     * @return JsonResponse
     */
    public function getAccount(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        $accounts = array();

        foreach ($user->getAccounts() as $account) {
             $accounts[] = array(
                 'id' => $account->getId(),
                 'name' => $account->getName(),
                 'url' => $account->getUrl(),
                 'secretKey' => $account->getSecretKey(),
             );
        }


        return new JsonResponse($accounts, Response::HTTP_OK);
    }

    /**
     * @Route("/api/account/", name="create_account", methods={ "POST" })
     * @param Request $request
     * @return JsonResponse
     */
    public function createAccount(Request $request, AccountRepository $accountRepository): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        $account = json_decode($request->getContent());

        $newAccount = new Account();
        $newAccount->setUser($user);
        $newAccount->setName($account->name);
        $newAccount->setSecretKey($account->secretKey);
        if($account->url) $newAccount->setUrl($account->url);

        $accountRepository->save($newAccount);

        return new JsonResponse(
            ['accountId' => $newAccount->getId()]
        , Response::HTTP_OK);
    }

}