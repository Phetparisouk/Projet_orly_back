<?php

namespace App\Repository;

use App\Entity\Ville;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ville|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ville|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ville[]    findAll()
 * @method Ville[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VilleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ville::class);
    }

    /**
    * @return Ville[] Returns an array of Ville objects
    */

   public function findByName($data)
    {
        $parameter = json_decode($data, true);
        return $this->createQueryBuilder('v')
            ->andWhere('v.nom_ville = :nom_ville')
            ->setParameter('nom_ville', $parameter['nom_ville'])
            ->orderBy('v.nom_ville', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByType($data)
    {
        $parameter = json_decode($data, true);
        return $this->createQueryBuilder('v')
            ->andWhere('v.nom_ville = :nom_ville')
            ->setParameter('nom_ville', $parameter['nom_ville'])
            ->orderBy('v.nom_ville', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByCriteria($data)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.nom_ville = :nom_ville')
            ->setParameter('nom_ville', $data['nom_ville'])
            ->orderBy('v.nom_ville', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
