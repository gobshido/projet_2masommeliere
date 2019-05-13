<?php

namespace App\Repository;

use App\Entity\Contactuser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Contactuser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contactuser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contactuser[]    findAll()
 * @method Contactuser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactuserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contactuser::class);
    }

    // /**
    //  * @return Contactuser[] Returns an array of Contactuser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contactuser
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
