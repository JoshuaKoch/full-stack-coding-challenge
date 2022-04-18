<?php

namespace App\Repository;

use App\Entity\PizzaIngredientsRels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PizzaIngredientsRels|null find($id, $lockMode = null, $lockVersion = null)
 * @method PizzaIngredientsRels|null findOneBy(array $criteria, array $orderBy = null)
 * @method PizzaIngredientsRels[]    findAll()
 * @method PizzaIngredientsRels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PizzaIngredientsRelsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PizzaIngredientsRels::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PizzaIngredientsRels $entity, bool $flush = true): void
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
    public function remove(PizzaIngredientsRels $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return PizzaIngredientsRels[] Returns an array of PizzaIngredientsRels objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PizzaIngredientsRels
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
