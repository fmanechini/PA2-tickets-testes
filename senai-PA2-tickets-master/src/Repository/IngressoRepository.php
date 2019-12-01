<?php

namespace App\Repository;

use App\Entity\Ingresso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ingresso|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ingresso|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ingresso[]    findAll()
 * @method Ingresso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngressoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingresso::class);
    }

    // /**
    //  * @return Ingresso[] Returns an array of Ingresso objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findByCodigo($evento)
    {
        return $this->createQueryBuilder('i')
            ->select('MAX(i.codigo)')
            ->where('i.id_evento = :evento')
            ->setParameter('evento', $evento)
            ->getQuery()
            ->getResult();
    }

}
