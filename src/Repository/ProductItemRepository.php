<?php

namespace App\Repository;

use App\Entity\ProductItem;
use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductItem>
 *
 * @method ProductItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductItem[]    findAll()
 * @method ProductItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductItem::class);
    }

    public function add(ProductItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProductItem $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // TODO - Add a method to show only the first 10 products that have expiring productItems
    public function findFirstTenProductItemsExpiringWithinFifteenDays()
    {
        return $this->createQueryBuilder('productItem')
            ->addCriteria(self::createExpiringCriteria())
            ->orderBy('productItem.useByDate', 'ASC')
            ->setMaxResults(10)
            ->innerJoin('productItem.product', 'product')
            ->addSelect('product')
            ->getQuery()
            ->getResult();
    }

    // TODO - Add a method to show all the products that have expiring productItems
    public function findAllProductItemsExpiringWithinFifteenDays()
    {
        return $this->createQueryBuilder('productItem')
            ->addCriteria(self::createExpiringCriteria())
            ->orderBy('productItem.useByDate', 'ASC')
            ->innerJoin('productItem.product', 'product')
            ->addSelect('product')
            ->getQuery()
            ->getResult();
    }

    public static function createExpiringCriteria(): Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->andX(
                Criteria::expr()->lte('useByDate', Carbon::now()->addDays(15)),
                Criteria::expr()->gte('useByDate', Carbon::now())
            ));
    }


//    /**
//     * @return ProductItem[] Returns an array of ProductItem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProductItem
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}

