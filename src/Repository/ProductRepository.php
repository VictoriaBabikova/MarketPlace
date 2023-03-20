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

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return Product[] Returns an array of Product objects
    */
    public function findByProductsQuery(
        $value,
        $price = null,
        $title = null,
        $seller = null,
        $feedbacksOnly = null,
        $info = null,
        $popular = null,
        $priceSort = null,
        $feedbacks = null,
        $novelty = null
    ) {

        $min = null;
        $max = null;
        if (isset($price)) {
            $arrPrice = explode(";", $price);
            $min = $arrPrice[0];
            $max = $arrPrice[1];
        }
        

        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->addSelect('c')
            ->leftJoin('p.sellers', 's')
            ->addSelect('s')
            ->andWhere('c.category = :val')
            ->setParameter('val', $value);
            
        if ($min !== null && $max !== null) {
            $qb
            ->andWhere(
                $qb->expr()->between('p.pricein', $min, $max)
            );
        }
        if ($title !== null && $title !== "") {
            $qb
                ->andWhere('p.productname LIKE :title')
                ->setParameter('title', "%$title%")
            ;
        }
        if ($seller !== null) {
            $qb
                ->andWhere('s.name LIKE :seller')
                ->setParameter('seller', "%$seller%")
            ;
        }
        if ($feedbacksOnly !== null || $feedbacks == true) {
            $qb
                ->innerJoin('p.feedback', 'f')
                ->addSelect('f')
            ;
        }
        if ($info !== null) {
            $qb
                ->andWhere('p.info LIKE :info')
                ->setParameter('info', "%$info%")
            ;
        }

        if ($priceSort !== null) {
            $qb
                ->orderBy('p.pricesale', 'ASC');
        }

        if ($novelty !== null) {
            $qb
                ->orderBy('p.createdAt', 'DESC');
        }

        return $qb;
        ;
    }

    // public function findByProducts($value): array
    // {
    //     return $this->createQueryBuilder('p')
    //         ->leftJoin('p.category', 'c')
    //         ->addSelect('c')
    //         ->andWhere('c.category = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    public function findAllProducts(): array
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findProduct($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.category', 'c')
            ->addSelect('c')
            ->leftJoin('p.sellers', 's')
            ->addSelect('s')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findTopEightProducts(): array
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult()
        ;
    }
}
