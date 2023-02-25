<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EducationController extends AbstractController
{

    #[Route('/education', name: 'education_page')]
    public function index(): Response
    {        
        return $this->render('main/education.html.twig', [
            'current_route' => 'education_page'
        ]);
    }
}