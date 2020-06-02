<?php

namespace App\Repository;

use App\Entity\RefPokemonType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RefPokemonType|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefPokemonType|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefPokemonType[]    findAll()
 * @method RefPokemonType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefPokemonTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefPokemonType::class);
    }

    public function getPokemonsTypeByZone($zoneId) {
        $conn = $this->getEntityManager()->getConnection();
        $req1 = "select t.id_type 
                from ref_elementary_type as r, zone_capture as z, type_by_zone as t 
                WHERE z.id = ". $zoneId . " and t.id_zone_capture = z.id and t.id_type = r.id 
                GROUP BY (t.id_type) ORDER BY t.id_type ASC";
        $stmt1 = $conn->prepare($req1);
        $stmt1->execute();
        $list = array();
        foreach ($stmt1 as $row) {
            $list[] = $row['id_type'];
        }

        $string = implode(",", $list);



        $req2 = "SELECT * 
                FROM ref_pokemon_type as r 
                WHERE r.type_1 in (" . $string . ") or r.type_2 in (" . $string . ") 
                GROUP by r.id";
        $stmt2 = $conn->prepare($req2);
        $stmt2->execute();
        return $stmt2->fetchAll();

    }

    // /**
    //  * @return RefPokemonType[] Returns an array of RefPokemonType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RefPokemonType
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
