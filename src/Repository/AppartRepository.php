<?php

namespace App\Repository;

use App\Entity\Appart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Appart>
 *
 * @method Appart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appart[]    findAll()
 * @method Appart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appart::class);
    }

//    /**
//     * @return Appart[] Returns an array of Appart objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Appart
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
