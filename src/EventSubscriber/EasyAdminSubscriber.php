<?php

namespace App\EventSubscriber;

use App\Entity\Project;
use App\Entity\ProjectImages;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\String\Slugger\SluggerInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private SluggerInterface $slugger,
        private EntityManagerInterface $em,
        private ParameterBagInterface $params,
        private Filesystem $fileSystem
    ) {
        $this->slugger = $slugger;
        $this->em = $em;
        $this->params = $params;
        $this->fileSystem = $fileSystem;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['addImages'],
            BeforeEntityUpdatedEvent::class => ['addImages'],
            BeforeEntityDeletedEvent::class => ['removeImages'],
            BeforeEntityDeletedEvent::class => ['removeImage'],
            BeforeEntityPersistedEvent::class => ['addImage'],
            BeforeEntityUpdatedEvent::class => ['addImage'],
        ];
    }

    public function addImages(BeforeEntityPersistedEvent|BeforeEntityUpdatedEvent $event)
    {
        $project = $event->getEntityInstance();

        if (!$project instanceof Project) return;

        $uploadedFiles = $project->getUploadedFiles();
        if ($uploadedFiles) {
            foreach ($uploadedFiles as $uploadedFile) {
                $image = new ProjectImages();

                $path = 'uploads/projectImages/' . $uploadedFile;
                $image
                    ->setPath($path)
                    ->setProject($project);
                $this->em->persist($image);
            }
        }
    }

    public function removeImages(BeforeEntityDeletedEvent $event)
    {
        $project = $event->getEntityInstance();

        if (!$project instanceof Project) return;

        $images = $project->getImages();

        foreach ($images as $image) {
            if ($image) {
                $this->fileSystem->remove($image->getPath());
            }
        }
    }

    public function removeImage(BeforeEntityDeletedEvent $event)
    {
        $image = $event->getEntityInstance();

        if (!$image instanceof ProjectImages) return;

        $this->fileSystem->remove($image->getPath());
    }

    public function addImage(BeforeEntityPersistedEvent|BeforeEntityUpdatedEvent $event)
    {
        $image = $event->getEntityInstance();

        if (!$image instanceof ProjectImages) return;

        $path = 'uploads/projectImages/' . $image->getUploadedFile();
        $image->setPath($path);
    }
}
