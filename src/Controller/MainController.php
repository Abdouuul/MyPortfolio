<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use App\Repository\UpdateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private UpdateRepository $updateRepository,
        private ProjectRepository $projectRepository
    ) {
        $this->em = $em;
        $this->updateRepository = $updateRepository;
        $this->projectRepository = $projectRepository;
    }

    #[Route('/', name: 'main_homepage')]
    public function index(): Response
    {
        $recentUpdates = $this->updateRepository->getLatestUpdatesWithAllDetails();
        $recentProjects = $this->projectRepository->getAllRecentProjects();
        $latestUpdatedProject = $this->updateRepository->getLatestUpdateWithDetails()->getProject();

       

        return $this->render('main/home.html.twig', [
            'current_route' => 'main_homepage',
            'recentUpdates' => $recentUpdates,
            'recentProjects' => $recentProjects,
            'latestUpdatedProject' => $latestUpdatedProject
        ]);
    }

    #[Route('/about', name: 'about_page')]
    public function about(): Response
    {
        return $this->render('main/about.html.twig', [
            'current_route' => 'about_page',
        ]);
    }
}
