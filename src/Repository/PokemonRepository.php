<?php

namespace App\Repository;

use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pokemon[]    findAll()
 * @method Pokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    // /**
    //  * @return Pokemon[] Returns an array of Pokemon objects
    //  */

    public function getPokemonByDresseurId($dresseurId){
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT * FROM pokemon WHERE dresseurId ='. $dresseurId;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPokemonReadyForCapture($dresseurId) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT *
                FROM pokemon
                WHERE idp NOT IN
                    (SELECT idp
                     FROM pokemon
                     WHERE (derniereChasse > DATE_SUB(Now(), INTERVAL 1 HOUR)))
                  AND idp NOT IN
                    (SELECT idp
                     FROM pokemon
                     WHERE (dernierEntrainement > DATE_SUB(Now(), INTERVAL 1 HOUR)))
                  AND dresseurId = ' . $dresseurId ;
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateDerniereChasse($idp) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'UPDATE POKEMON SET derniereChasse = Now() where idp =' . $idp;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    public function verifyIfPossibleToTrain($dresseurId, $idPoke) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT *
                FROM pokemon
                WHERE idp NOT IN
                    (SELECT idp
                     FROM pokemon
                     WHERE (derniereChasse > DATE_SUB(Now(), INTERVAL 1 HOUR)))
                  AND idp NOT IN
                    (SELECT idp
                     FROM pokemon
                     WHERE (dernierEntrainement > DATE_SUB(Now(), INTERVAL 1 HOUR)))
                  AND dresseurId = ' . $dresseurId . '
                  AND idp = ' . $idPoke;
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateDernierEntrainement($idp) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'UPDATE POKEMON SET dernierEntrainement = Now() where idp =' . $idp;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    public function updateXp($idp, $xp) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'UPDATE POKEMON SET xp =' . $xp . ' WHERE idp =' . $idp;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    public function updateNiveau($idp, $niveau) {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'UPDATE POKEMON SET niveau =' . $niveau . ' WHERE idp =' . $idp;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }




    // /**
    //  * @return Pokemon[] Returns an array of Pokemon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pokemon
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
