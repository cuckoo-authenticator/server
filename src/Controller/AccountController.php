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
use Symfony\Component\Uid\Uuid;


class AccountController extends AbstractController
{
    /**
     * @Route("/api/account", name="get_account_ids", methods={ "GET" })
     * @return JsonResponse
     */
    public function getAccountIDs(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        $accounts = array();

        foreach ($user->getAccounts() as $account) {
             $accounts[] = array(
                 'id' => $account->getId(),
             );
        }

        return new JsonResponse($accounts, Response::HTTP_OK);
    }

    /**
     * @Route("/api/account", name="create_account", methods={ "POST" })
     * @param Request $request
     * @param AccountRepository $accountRepository
     * @return Response
     */
    public function createAccount(Request $request, AccountRepository $accountRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $account = json_decode($request->getContent());

        $newAccount = new Account();
        $newAccount->setId(new Uuid($account->id));
        $newAccount->setUser($user);
        $newAccount->setName($account->name);
        $newAccount->setSecretKey($account->secretKey);
        $newAccount->setUrl($account->url);

        $accountRepository->save($newAccount);

        return new Response(null, Response::HTTP_OK);
    }

    /**
     * @Route("/api/account/{id}", name="delete_account", methods={ "DELETE" })
     * @param Account $account
     * @param AccountRepository $accountRepository
     * @return Response
     */
    public function deleteAccount(Account $account, AccountRepository $accountRepository): Response
    {
        // TODO: make sure to check if this account belongs to the user and only then delete

        $accountRepository->delete($account);

        return new Response(null, Response::HTTP_OK);
    }

    /**
     * @Route("/api/account/{id}", name="get_account", methods={ "GET" })
     * @param Account $account
     * @return JsonResponse
     */
    public function getAccount(Account $account): JsonResponse
    {
        // TODO: make sure to check if this account belongs to the user and only then return it

        return new JsonResponse(array(
            'id' => $account->getId(),
            'name' => $account->getName(),
            'url' => $account->getUrl(),
            'secretKey' => $account->getSecretKey(),
        ), Response::HTTP_OK);
    }
}
