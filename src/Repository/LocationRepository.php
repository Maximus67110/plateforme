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

    public function search(string $where, string $begin, string $end, int $capacity): array
    {
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
