<?php

namespace App\Repository;

use App\Entity\BuildingState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BuildingState>
 *
 * @method BuildingState|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuildingState|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuildingState[]    findAll()
 * @method BuildingState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuildingStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuildingState::class);
    }

    //    /**
    //     * @return BuildingState[] Returns an array of BuildingState objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    public function findOneByLevel($id, $level): ?BuildingState
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.level = :level')
            ->setParameter('level', $level)
            ->andWhere('b.building = :buildingId')
            ->setParameter('buildingId', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
