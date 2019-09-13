<?php

namespace App\Repository;

use App\Entity\Pays;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pays|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pays|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pays[]    findAll()
 * @method Pays[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Pays::class);
    }

    public function findByContinent($nom_continent) {
        $result = $this->createQueryBuilder('p')
            ->join('p.continent', 'continent')
            ->where('continent.nom_continent = :nom_continent')
            ->setParameters([
                'nom_continent' => $nom_continent
            ])
            ->getQuery()
            ->getResult();
        return $result;
    }
}
