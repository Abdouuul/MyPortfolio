<?php

namespace App\Controller\Admin;

use App\Entity\Experience;
use App\Entity\Project;
use App\Entity\Skill;
use App\Entity\Update;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        
        $url = $this->adminUrlGenerator
            ->setController(ProjectCrudController::class)
            ->generateUrl();

        return $this->redirect($url);        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MyPortfolio');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fa fa-person', User::class);
        yield MenuItem::linkToCrud('Projects', 'fa fa-laptop', Project::class);
        yield MenuItem::linkToCrud('Updates', 'fa fa-refresh', Update::class);
        yield MenuItem::linkToCrud('Skills', 'fa fa-cogs', Skill::class);
        yield MenuItem::linkToCrud('Experiences', 'fa fa-book', Experience::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
