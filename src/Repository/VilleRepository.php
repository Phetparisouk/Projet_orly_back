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

    public function findByPays($nomPays){
        $result = $this->createQueryBuilder('v')
            ->join('v.pays', 'pays')
            ->where('pays.nom_pays = :pays')
            ->setParameters([
                'pays' => $nomPays
            ])
            ->getQuery()
            ->getResult();
        return $result;
    }

    public function findByType($nomType)
    {
        $result = $this->createQueryBuilder('v')
            ->join('v.type', 'type')
            ->where('type.nom_type = :type')
            ->setParameters([
                'type' => $nomType
            ])
            ->getQuery()
            ->getResult();
        return $result;
    }

    public function findByCriteria($degre, $mois, $pays, $type)
    {
        return $this->createQueryBuilder('v')
            ->select('v.nom_ville, v.budget, pays.nom_pays, type.nom_type, t.degre, t.mois')
            ->join('v.temperature', 't')
            ->join('v.type', 'type')
            ->join('v.pays', 'pays')
            ->where('type.nom_type = :type')
            ->andWhere('pays.nom_pays = :pays')
            ->andWhere('t.degre > :degre')
            ->andWhere('t.mois = :mois')
            ->setParameters([
                'degre' => $degre,
                'mois' => $mois,
                'pays' => $pays,
                'type' => $type,
            ])
            ->orderBy('v.nom_ville', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }
}
