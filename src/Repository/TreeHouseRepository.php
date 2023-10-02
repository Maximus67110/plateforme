<?php

namespace App\Repository;

use App\Entity\TreeHouse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TreeHouse>
 *
 * @method TreeHouse|null find($id, $lockMode = null, $lockVersion = null)
 * @method TreeHouse|null findOneBy(array $criteria, array $orderBy = null)
 * @method TreeHouse[]    findAll()
 * @method TreeHouse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TreeHouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TreeHouse::class);
    }

//    /**
//     * @return TreeHouse[] Returns an array of TreeHouse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TreeHouse
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
