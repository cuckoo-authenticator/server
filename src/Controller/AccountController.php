<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\User;
use App\Repository\AccountRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;


class AccountController extends AbstractController
{
    /**
     * @Route("/api/account", name="account_get", methods={ "GET" })
     * @return JsonResponse
     */
    public function getAccount(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        $accounts = array();

        foreach ($user->getAccounts() as $account) {
             $accounts[] = array(
                 'accountId' => $account->getId(),
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
        if($account->url) $newAccount->setUrl($account->url);

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
        $accountRepository->delete($account);

        return new Response(null, Response::HTTP_OK);
    }
}
