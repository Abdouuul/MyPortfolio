<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    public function __construct(
        private AuthenticationUtils $authenticationUtils,
        private Security $security,
    ) {
        $this->authenticationUtils = $authenticationUtils;
        $this->security = $security;
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
            'loggedInUser' => null
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
    }
}
