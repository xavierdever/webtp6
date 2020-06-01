<?php

namespace App\Repository;

use App\Entity\ZoneCapture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ZoneCapture|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZoneCapture|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZoneCapture[]    findAll()
 * @method ZoneCapture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZoneCaptureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZoneCapture::class);
    }

    // /**
    //  * @return ZoneCapture[] Returns an array of ZoneCapture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ZoneCapture
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
