<?php

namespace App\Repository;

use App\Entity\UwMeaningRelations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UwMeaningRelations|null find($id, $lockMode = null, $lockVersion = null)
 * @method UwMeaningRelations|null findOneBy(array $criteria, array $orderBy = null)
 * @method UwMeaningRelations[]    findAll()
 * @method UwMeaningRelations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UwMeaningRelationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UwMeaningRelations::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(UwMeaningRelations $entity, bool $flush = true): void
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
    public function remove(UwMeaningRelations $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return UwMeaningRelations[] Returns an array of UwMeaningRelations objects
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
    public function findOneBySomeField($value): ?UwMeaningRelations
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
