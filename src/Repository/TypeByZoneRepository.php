<?php

namespace App\Repository;

use App\Entity\TypeByZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeByZone|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeByZone|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeByZone[]    findAll()
 * @method TypeByZone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeByZoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeByZone::class);
    }

    // /**
    //  * @return TypeByZone[] Returns an array of TypeByZone objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeByZone
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
