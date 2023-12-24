<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

   public function findLatest(): array
   {
       return $this->createQueryBuilder('product')
            ->addSelect('comments', 'tags')
            ->leftJoin('product.comments', 'comments')
            ->leftJoin('product.tags', 'tags')
            ->orderBy('product.id', 'DESC')
            ->getQuery()
            ->getResult();
   }

   public function findByTags($tag): array
   {
        return $this->createQueryBuilder('product')
            
            ->setParameter('tag', $tag)
            ->andWhere(':tag MEMBER OF product.tags')

            ->addSelect('comments', 'tags')
            ->leftJoin('product.comments', 'comments')
            ->leftJoin('product.tags', 'tags')
            ->orderBy('product.id', 'DESC')
            ->getQuery()
            ->getResult();
   }
//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
