<?php

namespace App\Repository;

use App\Entity\UwTranslatedContentAttributeValues;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UwTranslatedContentAttributeValues|null find($id, $lockMode = null, $lockVersion = null)
 * @method UwTranslatedContentAttributeValues|null findOneBy(array $criteria, array $orderBy = null)
 * @method UwTranslatedContentAttributeValues[]    findAll()
 * @method UwTranslatedContentAttributeValues[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UwTranslatedContentAttributeValuesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UwTranslatedContentAttributeValues::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(UwTranslatedContentAttributeValues $entity, bool $flush = true): void
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
    public function remove(UwTranslatedContentAttributeValues $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return UwTranslatedContentAttributeValues[] Returns an array of UwTranslatedContentAttributeValues objects
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
    public function findOneBySomeField($value): ?UwTranslatedContentAttributeValues
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
