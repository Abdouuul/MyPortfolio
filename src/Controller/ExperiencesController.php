<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperiencesController extends AbstractController{

    #[Route('/experiences', name: 'experiences_page')]
    public function index(): Response
    {        
        return $this->render('main/experiences.html.twig', [
            'current_route' => 'experiences_page'
        ]);
    }
}