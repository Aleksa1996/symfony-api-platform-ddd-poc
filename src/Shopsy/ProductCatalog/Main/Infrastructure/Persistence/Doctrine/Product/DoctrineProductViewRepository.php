<?php

namespace App\Shopsy\ProductCatalog\Main\Infrastructure\Persistence\Doctrine\Product;

use App\Common\Domain\Id;
use Doctrine\Persistence\ManagerRegistry;
use App\Common\Domain\RepositoryQueryResult;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Shopsy\ProductCatalog\Main\Domain\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Shopsy\ProductCatalog\Main\Domain\Product\ProductViewRepository;
use App\Shopsy\ProductCatalog\Main\Infrastructure\Persistence\Doctrine\Product\Query\DoctrineProductCriteriaBuilder;

class DoctrineProductViewRepository extends ServiceEntityRepository implements ProductViewRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @inheritDoc
     */
    public function findById(Id $id): Product
    {
        return $this->find($id);
    }

    /**
     * @inheritDoc
     */
    public function findByName(string $name): Product
    {
        return $this
            ->createQueryBuilder('r')
            ->where('r.name = :name')
            ->setParameter('name', $name)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @inheritDoc
     */
    public function query(array $filters = [], int $page = 1, int $limit = 10, array $sort = []): RepositoryQueryResult
    {
        $criteriaBuilder = new DoctrineProductCriteriaBuilder(
            $filters,
            $page,
            $limit,
            $sort
        );

        $queryBuilder = $this->createQueryBuilder('r')->addCriteria($criteriaBuilder->build());
        $paginator = new Paginator($queryBuilder);

        return new RepositoryQueryResult(
            iterator_to_array($paginator),
            $page,
            $limit,
            count($paginator)
        );
    }
}
