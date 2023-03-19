<?php

namespace App\Repository;

use App\Entity\Experience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Experience|null find($id, $lockMode = null, $lockVersion = null)
 * @method Experience|null findOneBy(array $criteria, array $orderBy = null)
 * @method Experience[]    findAll()
 * @method Experience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class ExperienceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, Experience::class);
    }

    public function getAllExperiencesInOrder(): ?array
    {
        $qb = $this
            ->createQueryBuilder('e')
            ->orderBy('e.startDate', 'DESC');
        return $qb->getQuery()->getResult();
    }
}
