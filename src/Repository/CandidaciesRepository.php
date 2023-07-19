<?php

namespace App\Repository;

use App\Entity\Candidacies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Candidacies>
 *
 * @method Candidacies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Candidacies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Candidacies[]    findAll()
 * @method Candidacies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidaciesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Candidacies::class);
    }

//    /**
//     * @return Candidacies[] Returns an array of Candidacies objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Candidacies
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
