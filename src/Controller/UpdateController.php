<?php

namespace App\Controller;

use App\Entity\Update;
use App\Form\UpdateType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private ProjectRepository $projectRepository
    ) {
        $this->em = $em;
        $this->projectRepository = $projectRepository;
    }

    #[Route('/new/update', name: 'new_update_page')]
    public function new(Request $request): Response
    {
        $update = new Update();
        $form = $this->createForm(UpdateType::class, $update);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projectID = $update->getProject()->getId();
            $this->em->persist($update);
            $this->em->flush();
            
            return $this->redirectToRoute('projects_details_page', ['id' => $projectID]);
        }

        return $this->render('forms/update.html.twig', [
            'current_route' => 'new_update_page',
            'form' => $form->createView()
        ]);
    }
}
