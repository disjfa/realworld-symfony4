<?php

namespace App\Controller;

use App\Services\ApiClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/profile")
 */
class ProfileController extends Controller
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
     * @Route("/{username}", name="profile_index")
     */
    public function indexAction(string $username)
    {
        $profile = $this->apiClient->getProfile($username);
        $articles = $this->apiClient->getArticles(['author' => $username]);

        return $this->render('profile/index.html.twig', array_merge($profile, $articles));
    }
}