<?php

namespace App\Repository;

use App\Entity\LanguageNames;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LanguageNames|null find($id, $lockMode = null, $lockVersion = null)
 * @method LanguageNames|null findOneBy(array $criteria, array $orderBy = null)
 * @method LanguageNames[]    findAll()
 * @method LanguageNames[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LanguageNamesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LanguageNames::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(LanguageNames $entity, bool $flush = true): void
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
    public function remove(LanguageNames $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findLanguages() {
        $query = $this->_em->createQuery("SELECT ln.language_id, ln.language_name FROM App\Entity\LanguageNames ln WHERE ln.language_id = ln.name_language_id ORDER BY ln.language_name ASC");
        $idiomas = $query->getResult();
        return $idiomas;
    }

    public function findLanguageById($id) {
        $query = $this->_em->createQuery("SELECT ln.language_id, ln.name_language_id, ln.language_name FROM App\Entity\LanguageNames ln WHERE ln.language_id = ln.name_language_id AND ln.language_id = " . $id);
        return $query->getResult()[0];
    }

    public function findLanguageByName($name) {
        $query = $this->_em->createQuery("SELECT ln.language_id FROM App\Entity\LanguageNames ln WHERE ln.language_id = ln.name_language_id AND ln.language_name LIKE '" . $name . "'");
        $id = $query->getResult()[0]["language_id"];
        $idioma = $this->findOneBy(["language_id" => $id, "name_language_id" => $id]);
        return $idioma;
    }

    // /**
    //  * @return LanguageNames[] Returns an array of LanguageNames objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LanguageNames
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
