<?php

namespace App\Repository;

use App\Entity\Pressbook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pressbook|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pressbook|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pressbook[]    findAll()
 * @method Pressbook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PressbookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pressbook::class);
    }

    // /**
    //  * @return Pressbook[] Returns an array of Pressbook objects
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
    public function findOneBySomeField($value): ?Pressbook
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
