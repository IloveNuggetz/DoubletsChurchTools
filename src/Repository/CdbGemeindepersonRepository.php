<?php

namespace App\Repository;

use App\Entity\CdbGemeindeperson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CdbGemeindeperson|null find($id, $lockMode = null, $lockVersion = null)
 * @method CdbGemeindeperson|null findOneBy(array $criteria, array $orderBy = null)
 * @method CdbGemeindeperson[]    findAll()
 * @method CdbGemeindeperson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CdbGemeindepersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CdbGemeindeperson::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CdbGemeindeperson $entity, bool $flush = true): void
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
    public function remove(CdbGemeindeperson $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return CdbGemeindeperson[] Returns an array of CdbGemeindeperson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CdbGemeindeperson
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
