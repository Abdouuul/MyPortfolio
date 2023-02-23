<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController{

    #[Route('/', name: 'main_homepage')]
    public function index(): Response
    {        
        return $this->render('main/index.html.twig', [
            'current_route' => 'current route'
        ]);
    }
}
