<?php

namespace App\Repository;

use App\Entity\LocalEvento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LocalEvento|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocalEvento|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocalEvento[]    findAll()
 * @method LocalEvento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalEventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocalEvento::class);
    }

    // /**
    //  * @return LocalEvento[] Returns an array of LocalEvento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LocalEvento
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
