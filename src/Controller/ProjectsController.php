<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\ProjectImages;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Repository\UpdateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private ProjectRepository $projectRepository,
        private UpdateRepository $updateRepository
    ) {
        $this->em = $em;
        $this->projectRepository = $projectRepository;
        $this->updateRepository = $updateRepository;
    }

    #[Route('/projects', name: 'projects_page')]
    public function index(): Response
    {
        $projects = $this->projectRepository->getAllProjectWithDetails();

        return $this->render('main/projects.html.twig', [
            'current_route' => 'projects_page',
            'controller_name' => 'projectsController',
            'projects' => $projects,
            'loggedInUser' => null
        ]);
    }

    #[Route('/projects/{id}', name: 'projects_details_page')]
    public function projectDetails(int $id): Response
    {
        $project = $this->projectRepository->findOneWithDetails($id);
        $recentUpdates = $this->updateRepository->getLatestProjectUpdates($project);
        if ($project === null) {
            throw new NotFoundHttpException();
        }
        return $this->render('details/projects-details.html.twig', [
            'current_route' => 'projects_details_page',
            'project' => $project,
            'recentUpdates' => $recentUpdates,
            'loggedInUser' => null
        ]);
    }
}
