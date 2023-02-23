<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController{

    #[Route('/projects', name: 'projects_page')]
    public function index(): Response
    {        
        return $this->render('main/projects.html.twig', [
            'current_route' => 'projects_page'
        ]);
    }

    #[Route('/projects/{id}', name: 'projects_details_page')]
    public function details(): Response
    {        
        return $this->render('details/projects-details.html.twig', [
            'current_route' => 'projects_details_page'
        ]);
    }
}