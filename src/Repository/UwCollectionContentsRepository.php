<?php

namespace App\Repository;

use App\Entity\UwCollectionContents;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UwCollectionContents|null find($id, $lockMode = null, $lockVersion = null)
 * @method UwCollectionContents|null findOneBy(array $criteria, array $orderBy = null)
 * @method UwCollectionContents[]    findAll()
 * @method UwCollectionContents[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UwCollectionContentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UwCollectionContents::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(UwCollectionContents $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(UwCollectionContents $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return UwCollectionContents[] Returns an array of UwCollectionContents objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UwCollectionContents
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
