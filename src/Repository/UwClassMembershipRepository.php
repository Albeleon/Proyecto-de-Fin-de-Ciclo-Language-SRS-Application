<?php

namespace App\Repository;

use App\Entity\UwClassMembership;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UwClassMembership|null find($id, $lockMode = null, $lockVersion = null)
 * @method UwClassMembership|null findOneBy(array $criteria, array $orderBy = null)
 * @method UwClassMembership[]    findAll()
 * @method UwClassMembership[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UwClassMembershipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UwClassMembership::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(UwClassMembership $entity, bool $flush = true): void
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
    public function remove(UwClassMembership $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return UwClassMembership[] Returns an array of UwClassMembership objects
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
    public function findOneBySomeField($value): ?UwClassMembership
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
