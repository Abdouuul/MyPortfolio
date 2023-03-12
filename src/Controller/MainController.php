<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use App\Repository\UpdateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class MainController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private UpdateRepository $updateRepository,
        private ProjectRepository $projectRepository,
        private Security $security,
    ) {
        $this->em = $em;
        $this->updateRepository = $updateRepository;
        $this->projectRepository = $projectRepository;
        $this->security = $security;
    }

    #[Route('/', name: 'main_homepage')]
    public function index(): Response
    {
        $recentUpdates = $this->updateRepository->getLatestUpdatesWithAllDetails();
        $recentProjects = $this->projectRepository->getAllRecentProjects();
        $latestUpdatedProject = $this->updateRepository->getLatestUpdateWithDetails()?->getProject();
        $loggedInUser = $this->security->getUser();



        return $this->render('main/home.html.twig', [
            'current_route' => 'main_homepage',
            'controller_name' => 'mainController',
            'recentUpdates' => $recentUpdates,
            'recentProjects' => $recentProjects,
            'latestUpdatedProject' => $latestUpdatedProject,
            'loggedInUser' => $loggedInUser,
        ]);
    }

    #[Route('/about', name: 'about_page')]
    public function about(): Response
    {
        return $this->render('main/about.html.twig', [
            'current_route' => 'about_page',
            'controller_name' => 'mainController',
            'loggedInUser' => null
        ]);
    }
}
