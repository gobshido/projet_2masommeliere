<?php

namespace App\Repository;

use App\Entity\Actualite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Actualite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actualite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actualite[]    findAll()
 * @method Actualite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActualiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Actualite::class);
    }

//    /**
//     * @return Actualite[] Returns an array of Actualite objects
//     */
//    public function findByDate($criteria): array
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $query = $entityManager->createQuery(
//            'SELECT p
//            FROM App\Entity\Actualite p
//            ORDER BY p.date DESC'
//        )
//            ->setParameter('date', $criteria);
//        return $query->execute();

//        $qb = $this->createQueryBuilder('actualite')
//            ->andWhere('actualite.date = :date')
//            ->setParameter('date', $date)
//            ->orderBy('actualite.date', 'DESC')
//            ->getQuery();
//        return $qb->execute();
//    }

//     /**
//      * @return Actualite[] Returns an array of Actualite objects
//      */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Actualite
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
