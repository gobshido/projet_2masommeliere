<?php

namespace App\Repository;

use App\Entity\Targetprice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Targetprice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Targetprice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Targetprice[]    findAll()
 * @method Targetprice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TargetpriceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Targetprice::class);
    }

    // /**
    //  * @return Targetprice[] Returns an array of Targetprice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Targetprice
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
