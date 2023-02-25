<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{

    public function __construct
    (
        private EntityManagerInterface $em,
        private ProjectRepository $projectRepository
    )
    {
        $this->em = $em;
        $this->projectRepository = $projectRepository;
    }

    #[Route('/projects', name: 'projects_page')]
    public function index(): Response
    {        
        return $this->render('main/projects.html.twig', [
            'current_route' => 'projects_page'
        ]);
    }

    #[Route('/projects/{id}', name: 'projects_details_page')]
    public function projectDetails(int $id): Response
    {  
        $project = $this->projectRepository->find($id);
        return $this->render('details/projects-details.html.twig', [
            'current_route' => 'projects_details_page',
            'project' => $project
        ]);
    }
}