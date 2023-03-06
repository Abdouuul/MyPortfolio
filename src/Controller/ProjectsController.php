<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\ProjectImages;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Repository\UpdateRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
            'projects' => $projects
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
            'recentUpdates' => $recentUpdates
        ]);
    }
    #[Route('new/projects', name: 'projects_form_page')]
    public function newProject(Request $request, SluggerInterface $slugger): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $uploadedFiles = $form->get('uploadedFiles')->getData();

            foreach ($uploadedFiles as $uploadedFile) {
                $image = new ProjectImages();
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '-' . $project->getName() . '.' . $uploadedFile->guessExtension();

                $path = 'uploads/projectImages/' . $newFilename;
                $image
                    ->setPath($path)
                    ->setProject($project);
                $this->em->persist($image);

                try {
                    $uploadedFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $e->getMessage();
                    echo $e;
                }
            }

            $this->em->persist($project);
            $this->em->flush();

            return $this->redirectToRoute('projects_page');
        }

        return $this->render('forms/project.html.twig', [
            'current_route' => 'projects_form_page',
            'form' => $form->createView()
        ]);
    }
}
