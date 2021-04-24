<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Job::class);
    }

    public function findAllRanged(array $params)
    {
        $query = $this->createQueryBuilder('j')
            ->where('j.createdAt BETWEEN DATE_SUB(CURRENT_TIMESTAMP(), 30, \'DAY\') AND CONCAT(CURRENT_DATE(), \' 23:59:59\')');

        if (!empty($params['service'])) {
            $query->andWhere('j.service = :service')
                ->setParameter('service',$params['service']);
        }

        if (!empty($params['zipcode'])) {
            $query->andWhere('j.zipcode = :zipcode')
                ->setParameter('zipcode',$params['zipcode']);
        }

        return $query->getQuery()->getResult();
    }


//    /**
//     * @return Job[] Returns an array of Job objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Job
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
