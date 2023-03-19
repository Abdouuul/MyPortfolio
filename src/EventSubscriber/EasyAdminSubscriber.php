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
        ];
    }

    public function addImages(BeforeEntityPersistedEvent|BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Project){

            $uploadedFiles = $entity->getUploadedFiles();
            if ($uploadedFiles) {
                foreach ($uploadedFiles as $uploadedFile) {
                    $image = new ProjectImages();
    
                    $path = 'uploads/projectImages/' . $uploadedFile;
                    $image
                        ->setPath($path)
                        ->setProject($entity);
                    $this->em->persist($image);
                }
            }
        } elseif ($entity instanceof ProjectImages) {
            $path = 'uploads/projectImages/' . $entity->getUploadedFile();
            $entity->setPath($path);
        }

    }

    public function removeImages(BeforeEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Project){

            $images = $entity->getImages();
    
            foreach ($images as $image) {
                if ($image) {
                    $this->fileSystem->remove($image->getPath());
                }
            }
        } elseif ($entity instanceof ProjectImages){
            $this->fileSystem->remove($entity->getPath());
        }

    }
}
