<?php

namespace App\Controller;

use App\Services\ApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
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
     * @Route("/", name="home_index")
     */
    public function indexAction()
    {
        return $this->render('home/home.html.twig', $this->apiClient->getArticles());
    }
}