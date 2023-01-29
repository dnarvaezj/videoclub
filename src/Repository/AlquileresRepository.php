<?php

namespace App\Repository;

use App\Entity\Alquileres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Alquileres>
 *
 * @method Alquileres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alquileres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alquileres[]    findAll()
 * @method Alquileres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlquileresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alquileres::class);
    }

    public function save(Alquileres $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Alquileres $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findUsersJoinedToAlquileres(): array {

        $entityManager = $this->getEntityManager();

        // $query = $entityManager->createQuery(
        //     'SELECT a, u
        //     FROM App\Entity\Alquileres a
        //     INNER JOIN a.user u'
        // );

        $query = $entityManager->createQuery(
            'SELECT a.id, a.valorTotal, a.fechaInicio, a.fechaFin, a.diasAlquiler, u.fullName
            FROM App\Entity\Alquileres a
            INNER JOIN a.user u'
        );

        return $query->getResult();
    }

//    /**
//     * @return Alquileres[] Returns an array of Alquileres objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Alquileres
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
