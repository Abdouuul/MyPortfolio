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

class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Project::class);
    }

    public function getAllProjectWithDetails(): ?array
    {
        $qb = $this
            ->createQueryBuilder('p');
        $this->addUpdates($qb);
        $this->addImages($qb);
        return $qb
            ->getQuery()
            ->getResult();
    }

    public function getAllRecentProjects(): ?array
    {
        $qb = $this
            ->createQueryBuilder('p')
            ->orderBy('p.startDate', 'DESC')
            ->setMaxResults(3);
        $this->addImages($qb);
        return $qb->getQuery()->getResult();
    }

    public function findOneWithDetails(int $id): ?Project
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id);
        $this->addUpdates($qb);
        $this->addImages($qb);
        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function addUpdates(QueryBuilder $qb)
    {
        $qb
            ->addSelect('u')
            ->leftJoin('p.updates', 'u');
    }

    public function addImages(QueryBuilder $qb)
    {
        $qb
            ->addSelect('im')
            ->orderBy('im.createdAt', 'ASC')
            ->leftJoin('p.images', 'im');
    }
}
