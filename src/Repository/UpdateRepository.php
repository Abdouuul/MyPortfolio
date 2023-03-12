<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\Update;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Update|null find($id, $lockMode = null, $lockVersion = null)
 * @method Update|null findOneBy(array $criteria, array $orderBy = null)
 * @method Update[]    findAll()
 * @method Update[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class UpdateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Update::class);
    }

    public function getLatestProjectUpdates(Project $project): ?array
    {
        $qb = $this
            ->createQueryBuilder('u')
            ->andWhere('u.project = :project')
            ->setParameter('project', $project)
            ->orderBy('u.createdAt', 'DESC')
            ->setMaxResults(5);

        return $qb->getQuery()->getResult();
    }

    public function getLatestUpdatesWithAllDetails(): ?array
    {
        $qb = $this
            ->createQueryBuilder('u')
            ->orderBy('u.createdAt', 'DESC')
            ->setMaxResults(5);
        $this->addProject($qb);
        return $qb
            ->getQuery()
            ->getResult();
    }

    public function getLatestUpdateWithDetails(): ?Update
    {
        $qb = $this
            ->createQueryBuilder('u')
            ->orderBy('u.createdAt', 'DESC')
            ->setMaxResults(1);
        $this->addProject($qb);
        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function addProject(QueryBuilder $qb)
    {
        $qb
            ->addSelect('p')
            ->innerJoin('u.project', 'p');
    }
}
