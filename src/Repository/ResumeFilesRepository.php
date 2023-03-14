<?php

namespace App\Repository;

use App\Entity\ResumeFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResumeFiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResumeFiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResumeFiles[]    findAll()
 * @method ResumeFiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class ResumeFilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, ResumeFiles::class);
    }
}
