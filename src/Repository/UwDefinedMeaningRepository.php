<?php

namespace App\Repository;

use App\Entity\UwDefinedMeaning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UwDefinedMeaning|null find($id, $lockMode = null, $lockVersion = null)
 * @method UwDefinedMeaning|null findOneBy(array $criteria, array $orderBy = null)
 * @method UwDefinedMeaning[]    findAll()
 * @method UwDefinedMeaning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UwDefinedMeaningRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UwDefinedMeaning::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(UwDefinedMeaning $entity, bool $flush = true): void
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
    public function remove(UwDefinedMeaning $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findDefinedMeaningsByWordsOrMeaning($srs, $nativeWord, $targetWord, $meaning) {
        
        $query = $this->_em->createQuery("SELECT ln.language_name FROM App\Entity\SRS srs, App\Entity\LanguageNames ln WHERE srs.id = " . $srs->getId() . " AND srs.idiomaNativo = ln.language_id AND ln.language_id = ln.name_language_id");
        $idiomaNativo = $query->getResult()[0]["language_name"];

        $query = $this->_em->createQuery("SELECT ln.language_name FROM App\Entity\SRS srs, App\Entity\LanguageNames ln WHERE srs.id = " . $srs->getId() . " AND srs.IdiomaObjetivo = ln.language_id AND ln.language_id = ln.name_language_id");
        $idiomaObjetivo = $query->getResult()[0]["language_name"];

        $textNative = empty($nativeWord) ? "" : "AND (xe2.spelling LIKE '". $nativeWord ."' OR xe2.spelling LIKE '". $nativeWord ." %') ";
        $textTarget = empty($targetWord) ? "" : "AND (xe1.spelling LIKE '". $targetWord ."' OR xe1.spelling LIKE '". $targetWord ." %') ";

        $query = $this->_em->createQuery("SELECT dm.defined_meaning_id, e1.spelling AS spelling_1, e2.spelling AS spelling_2, t.text_text FROM App\Entity\UwExpression e1, App\Entity\UwExpression e2, App\Entity\UwSyntrans st1, App\Entity\UwSyntrans st2, App\Entity\UwDefinedMeaning dm, App\Entity\UwTranslatedContent tc, App\Entity\UwText t, App\Entity\LanguageNames ln1, App\Entity\LanguageNames ln2 WHERE dm.defined_meaning_id = ANY (SELECT xdm.defined_meaning_id FROM App\Entity\UwExpression xe1, App\Entity\UwExpression xe2, App\Entity\UwSyntrans xst1, App\Entity\UwSyntrans xst2, App\Entity\UwDefinedMeaning xdm, App\Entity\LanguageNames xln1, App\Entity\LanguageNames xln2 WHERE xln1.language_name LIKE '". $idiomaObjetivo . "' AND xln2.language_name LIKE '" . $idiomaNativo . "' " . $textNative . $textTarget . "AND xe1.language_id = xln1.language_id AND xe1.language_id = xln1.name_language_id AND xe2.language_id = xln2.language_id AND xe2.language_id = xln2.name_language_id AND xe1.expression_id = xst1.expression_id AND xe2.expression_id = xst2.expression_id AND xst1.defined_meaning_id = xdm.defined_meaning_id AND xst2.defined_meaning_id = xdm.defined_meaning_id AND xe1.remove_transaction_id IS NULL AND xe2.remove_transaction_id IS NULL AND xst1.remove_transaction_id IS NULL AND xst2.remove_transaction_id IS NULL AND xdm.remove_transaction_id IS NULL) AND ln1.language_name LIKE '". $idiomaObjetivo ."' AND ln2.language_name LIKE '". $idiomaNativo ."' AND e1.language_id = ln1.language_id AND e1.language_id = ln1.name_language_id AND e2.language_id = ln2.language_id AND e2.language_id = ln2.name_language_id AND e1.expression_id = st1.expression_id AND e2.expression_id = st2.expression_id AND st1.defined_meaning_id = dm.defined_meaning_id AND st2.defined_meaning_id = dm.defined_meaning_id AND dm.meaning_text_tcid = tc.translated_content_id AND tc.language_id = e2.language_id AND tc.text_id = t.text_id AND e1.remove_transaction_id IS NULL AND e2.remove_transaction_id IS NULL AND st1.remove_transaction_id IS NULL AND st2.remove_transaction_id IS NULL AND dm.remove_transaction_id IS NULL AND tc.remove_transaction_id IS NULL");
        $objects = $query->getResult();


        //Organizar por cada significado y sus sinónimos
        $significados = [];
        foreach ($objects as $object) {
            $existe = false;
            foreach ($significados as &$significado) {
                if ($existe == false && $significado["id"] == $object["defined_meaning_id"]) {
                    $existe = true;
                }
            }

            if ($existe == false) {
                $nuevoSignificado = [];

                $nuevoSignificado["id"] = $object["defined_meaning_id"];
                $nuevoSignificado["significado"] = $object["text_text"];

                $sinonimosNativos = [];
                $sinonimosObjetivos = [];
                array_push($sinonimosNativos, $object["spelling_2"]);
                array_push($sinonimosObjetivos, $object["spelling_1"]);

                $nuevoSignificado['sinonimosNativos'] = $sinonimosNativos;
                $nuevoSignificado['sinonimosObjetivos'] = $sinonimosObjetivos;

                array_push($significados, $nuevoSignificado);

            }
            else {
                if (!in_array($object["spelling_1"], $significado["sinonimosObjetivos"])) {
                    array_push($significado['sinonimosObjetivos'], $object["spelling_1"]);
                }
                if (!in_array($object["spelling_2"], $significado["sinonimosNativos"])) {
                    array_push($significado['sinonimosNativos'], $object["spelling_2"]);
                }
            }
        }

        return $significados;
    }

    // /**
    //  * @return UwDefinedMeaning[] Returns an array of UwDefinedMeaning objects
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
    public function findOneBySomeField($value): ?UwDefinedMeaning
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
