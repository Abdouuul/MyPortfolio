<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    public function __construct(
        private AuthenticationUtils $authenticationUtils,
    ) {
        $this->authenticationUtils = $authenticationUtils;
    }

    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        $error = $this->authenticationUtils->getLastAuthenticationError();
        $lastUsername = $this->authenticationUtils->getLastUsername();


        return $this->render('forms/login.html.twig', [
            'current_route' => 'app_login',
            'controller_name' => 'loginController',
            'lastUsername' => $lastUsername,
            'error' => $error,
        ]);
    }
}
