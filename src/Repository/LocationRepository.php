<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Location>
 *
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    public function search(string $where = null, string $begin = null, string $end = null, int $capacity = null): array
    {
        $con = $this->getEntityManager()->getConnection();
        $sql = 'SELECT ville_departement, ville_nom_simple, ville_nom_reel, ville_latitude_deg, ville_longitude_deg FROM fixture_city where ville_nom_simple = :city';
        $resultSet = $con->executeQuery($sql, ['city' => $where]);
        $city = $resultSet->fetchAssociative();

        $qb = $this->createQueryBuilder('l')
            ->innerJoin('l.room', 'r')
            ->innerJoin('r.detail', 'rd')
            ->innerJoin('rd.bed', 'b')
            ->groupBy('l.id');
        if ($capacity) {
            $qb
                ->andHaving('SUM(rd.quantity * b.capacity) <= :capacity')
                ->setParameter('capacity', $capacity);
        }
        if ($city && $city["ville_latitude_deg"] && $city["ville_longitude_deg"]) {
            $qb->addSelect("ACOS(SIN(PI()*l.latitude/180.0)*SIN(PI()*:lat2/180.0)+COS(PI()*l.latitude/180.0)*COS(PI()*:lat2/180.0)*COS(PI()*:lon2/180.0-PI()*l.longitude/180.0))*6371 AS dist")
                ->setParameter(":lat2", $city["ville_latitude_deg"])
                ->setParameter(":lon2", $city["ville_longitude_deg"])
                ->orderBy("dist");
        }
        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Location
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
