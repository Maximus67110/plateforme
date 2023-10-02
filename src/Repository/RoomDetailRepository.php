<?php

namespace App\Repository;

use App\Entity\RoomDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RoomDetail>
 *
 * @method RoomDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoomDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoomDetail[]    findAll()
 * @method RoomDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoomDetail::class);
    }

//    /**
//     * @return RoomDetail[] Returns an array of RoomDetail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RoomDetail
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
