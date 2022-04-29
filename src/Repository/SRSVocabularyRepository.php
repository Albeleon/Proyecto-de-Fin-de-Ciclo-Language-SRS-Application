<?php

namespace App\Repository;

use App\Entity\SRSVocabulary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SRSVocabulary|null find($id, $lockMode = null, $lockVersion = null)
 * @method SRSVocabulary|null findOneBy(array $criteria, array $orderBy = null)
 * @method SRSVocabulary[]    findAll()
 * @method SRSVocabulary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SRSVocabularyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SRSVocabulary::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(SRSVocabulary $entity, bool $flush = true): void
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
    public function remove(SRSVocabulary $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function createSRSVocabulary($srs, $targetText, $nativeText, $meaning, $nivel) {
        
        $vocabulary = new SRSVocabulary();
        $vocabulary->setPalabrasObjetivo($targetText);
        $vocabulary->setPalabrasOrigen($nativeText);
        $vocabulary->setDescripcion($meaning);
        $vocabulary->setNivel($nivel);
        $vocabulary->setFechaProxima($this->getFecha(1));
        $vocabulary->setFallada(false);
        $vocabulary->setSRS($srs);

        $this->_em->persist($vocabulary);
        $this->_em->flush();
    }

    public function getFecha($nivel) {
        $fecha = $this->getHour();

        switch ($nivel) {
            case 1: $time = "PT4H"; break;
            case 2: $time = "PT8H"; break;
            case 3: $time = "PT24H"; break;
            case 4: $time = "PT48H"; break;
            case 5: $time = "PT168H"; break;
            case 6: $time = "PT336H"; break;
            case 7: $time = "PT720H"; break;
            case 8: $time = "PT2880H"; break;
            case 9: $time = "PT8640H"; break;
            default: return $fecha;
        }

        $fecha->add(new \DateInterval($time));
        return $fecha;
    }

    public function findRecentFromSRS($srs) {
        $query = $this->_em->createQuery("SELECT v.id, v.palabrasObjetivo, v.palabrasOrigen, v.descripcion, v.nivel, v.fallada FROM App\Entity\SRSVocabulary v WHERE v.SRS = " . $srs->getId() . " AND v.fechaProxima <= CURRENT_TIMESTAMP()");
        $result = $query->getResult();
        return $result;
    }

    public function levelUpOrDown($idVocabulary, $success) {
        $vocabulary = $this->findOneBy(["id" => $idVocabulary]);

        $level = ($success && !$vocabulary->getFallada()) ? $vocabulary->getNivel() + 1 : $vocabulary->getNivel() -1;
        $level = min(9, $level);
        $level = max(1, $level);

        $vocabulary->setNivel($level);
        $vocabulary->setFechaProxima($this->getFecha($vocabulary->getNivel()));
        $vocabulary->setFallada(false);

        $this->_em->persist($vocabulary);
        $this->_em->flush();

    }
    
    public function setAsFallada($idVocabulary) {
        $vocabulary = $this->findOneBy(["id" => $idVocabulary]);

        $vocabulary->setFallada(true);

        $this->_em->persist($vocabulary);
        $this->_em->flush();

    }

    public function getVocabularyPerHour($srs) {
        $list = [];
        $maxParameter = 1;

        for ($i = 1; $i <= 24; $i++) {
            $minHour = $this->addHour($this->getHour(), $i);
            $maxHour = $this->addHour($this->getHour(), $i + 1);
            $part = [];
            $part["hour"] = $minHour->format("H:i");

            $query = $this->_em->createQuery("SELECT count(v) as count FROM App\Entity\SRSVocabulary v WHERE v.SRS = " . $srs->getId() . " AND v.fechaProxima < '" . $maxHour->format("Y-m-d H:i:s") . "' AND v.fechaProxima >= '" . $minHour->format("Y-m-d H:i:s") . "'");
            $part["count"] = $query->getResult()[0]["count"];
    
            array_push($list, $part);

            $maxParameter = max($maxParameter, $part["count"]);
        }

        foreach ($list as &$section) {
            $section["height"] = 100 * $section["count"] / $maxParameter;
        }

        return $list;
    }

    public function getHour()
    {
        $dateTime = new \DateTime();
        $minuteInterval = 60;
        return $dateTime->setTime(
            $dateTime->format('H'),
            floor($dateTime->format('i') / $minuteInterval) * $minuteInterval,
            0
        );
    }

    public function addHour($fecha, $hour) {
        $time = "PT" . $hour . "H";
        $fecha->add(new \DateInterval($time));
        return $fecha;
    }

    public function delete($vocabulary) {
        $this->_em->remove($vocabulary);
        $this->_em->flush();
    }

    public function update($vocabulary, $targetText, $nativeText, $meaning, $nivel, $fecha) {
        $vocabulary->setPalabrasObjetivo($targetText);
        $vocabulary->setPalabrasOrigen($nativeText);
        $vocabulary->setDescripcion($meaning);
        $vocabulary->setNivel($nivel);
        $vocabulary->setFechaProxima(\DateTime::createFromFormat('Y/m/d H:i', $fecha));
        $vocabulary->setFallada(false);

        $this->_em->persist($vocabulary);
        $this->_em->flush();
    }

    // /**
    //  * @return SRSVocabulary[] Returns an array of SRSVocabulary objects
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
    public function findOneBySomeField($value): ?SRSVocabulary
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
