<?php

namespace App\Repository;

use App\Entity\HotelRoomCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HotelRoomCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelRoomCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelRoomCategory[]    findAll()
 * @method HotelRoomCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelRoomCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelRoomCategory::class);
    }

    // /**
    //  * @return HotelRoomCategory[] Returns an array of HotelRoomCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HotelRoomCategory
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
