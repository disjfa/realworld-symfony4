<?php

namespace App\Controller;


use App\form\type\UserLoginType;
use App\Services\ApiClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @var ApiClient
     */
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @Route("/login", name="user_login")
     */
    public function loginAction(Request $request)
    {
        $form = $this->createForm(UserLoginType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $res = $this->apiClient->autheticate($form->getData());
            dump($form->isValid());
            dump($res);
            exit;
        }
        return $this->render('user/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}