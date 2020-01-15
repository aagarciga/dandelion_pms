<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    // /**
    //  * @return Booking[] Returns an array of Booking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /**
     *
     * @param $start
     * @param $end

     * @return Booking[] Returns an array of Booking objects
     */
    public function findByPeriod($start, $end){
        return $this->createQueryBuilder('b')
            ->andWhere('b.checkInAt >= :start')
            ->andWhere('b.checkOutAt <= :end')
//            ->andWhere('b.isGuided = :guided')
            ->setParameters([
                'start' => $start,
                'end' => $end
//                'guided' => $guided
            ])
//            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function countPaxPerDay($date, $guided = false){
        return $this->createQueryBuilder('b')
            ->select('sum(b.adults)')
            ->andWhere('b.isGuided = :guided')
            ->andWhere('b.checkInAt <= :date')
            ->andWhere('b.checkOutAt >= :date')
            ->setParameters([
                'date' => $date,
                'guided' => $guided
            ])
            ->getQuery()
            ->getSingleScalarResult();
    }

    /*
    public function findOneBySomeField($value): ?Booking
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
