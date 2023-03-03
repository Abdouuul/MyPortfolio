<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\Update;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
            ->createQueryBuilder('update')
            ->andWhere('update.project = :project')
            ->setParameter('project', $project)
            ->orderBy('update.createdAt', 'DESC')
            ->setMaxResults(5);

        return $qb->getQuery()->getResult();
    }
}
