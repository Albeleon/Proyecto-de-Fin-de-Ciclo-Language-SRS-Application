<?php

namespace App\Repository;

use App\Entity\SRS;
use App\Entity\SRSVocabulary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SRS|null find($id, $lockMode = null, $lockVersion = null)
 * @method SRS|null findOneBy(array $criteria, array $orderBy = null)
 * @method SRS[]    findAll()
 * @method SRS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SRSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SRS::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(SRS $entity, bool $flush = true): void
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
    public function remove(SRS $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    
    public function createSRS($nombre, $idiomaObjetivo, $idiomaNativo, $user) {
        $srs = new SRS();
        $srs->setNombre($nombre);
        $srs->setIdiomaObjetivo($idiomaObjetivo);
        $srs->setIdiomaNativo($idiomaNativo);
        $srs->setUser($user);
        $srs->setFecha(new \DateTime('NOW'));

        $this->_em->persist($srs);
        $this->_em->flush();
        return $srs;
    }

    public function delete($srs) {
        $vocabularies = $srs->getSRSVocabularies();
        foreach ($vocabularies as $vocabulary) {
            $this->_em->remove($vocabulary);
        }
        $this->_em->remove($srs);
        $this->_em->flush();
    }

    // /**
    //  * @return SRS[] Returns an array of SRS objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SRS
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
