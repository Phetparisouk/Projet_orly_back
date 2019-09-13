<?php

namespace App\Repository;

use App\Entity\TypeVoyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeVoyage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeVoyage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeVoyage[]    findAll()
 * @method TypeVoyage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeVoyageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeVoyage::class);
    }
}
