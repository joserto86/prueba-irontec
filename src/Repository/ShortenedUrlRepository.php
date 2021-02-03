<?php

namespace App\Repository;

use App\Entity\ShortenedUrl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShortenedUrl|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShortenedUrl|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShortenedUrl[]    findAll()
 * @method ShortenedUrl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShortenedUrlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShortenedUrl::class);
    }

    public function saveShortenedUrl(ShortenedUrl $shortenedUrl) :bool
    {
        $this->_em->persist($shortenedUrl);
        $this->_em->flush();
        return true;
    }

    public function getAllShortenedUrls() :array
    {
        return $this->findAll();
    }

    public function getShortenedUrlByHash(string $hash) :?ShortenedUrl
    {
        return $this->findOneBy(['hash' => $hash]);
    }

    public function getTopMostVisitUrls($results) :array
    {
        return $this->createQueryBuilder('su')
            ->orderBy('su.visits', 'DESC')
            ->setMaxResults($results)
            ->getQuery()
            ->getResult();
    }

    public function getCountShortenedUrls() :int
    {
        return $this->createQueryBuilder('su')
            ->select('count(su.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getTotalVisitsShortenedUrls() :int
    {
        return $this->createQueryBuilder('su')
            ->select('SUM(su.visits)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return ShortenedUrl[] Returns an array of ShortenedUrl objects
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
    public function findOneBySomeField($value): ?ShortenedUrl
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
