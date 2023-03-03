<?php 

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

 class ProjectRepository extends ServiceEntityRepository{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Project::class);
    }

    public function findOneWithDetails(int $id): ?Project
    {
        $qb = $this->createQueryBuilder('project')
            ->andWhere('project.id = :id')
            ->setParameter('id', $id);
        $this->addUpdates($qb);
        $this->addImages($qb);
        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function addUpdates(QueryBuilder $qb){
        $qb
            ->addSelect('updates')
            ->leftJoin('project.updates', 'updates');
    }

    public function addImages(QueryBuilder $qb){
        $qb
            ->addSelect('images')
            ->leftJoin('project.images', 'images');
    }
 }