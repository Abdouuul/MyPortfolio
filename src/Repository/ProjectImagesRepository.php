<?php 

namespace App\Repository;

use App\Entity\ProjectImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjectImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectImages[]    findAll()
 * @method ProjectImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

 class ProjectImagesRepository extends ServiceEntityRepository{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ProjectImages::class);
    }
 }