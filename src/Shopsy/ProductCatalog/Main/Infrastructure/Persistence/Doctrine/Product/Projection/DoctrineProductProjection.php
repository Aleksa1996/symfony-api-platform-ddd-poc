<?php

namespace App\Shopsy\ProductCatalog\Main\Infrastructure\Persistence\Doctrine\Product\Projection;


use App\Common\Domain\Event\AggregateHistory;
use App\Common\Domain\Projects;
use Doctrine\Persistence\ManagerRegistry;
use App\Shopsy\ProductCatalog\Main\Domain\Product\Product;
use App\Shopsy\ProductCatalog\Main\Domain\Product\ProductCreated;
use App\Shopsy\ProductCatalog\Main\Domain\Product\ProductProjection;
use App\Shopsy\ProductCatalog\Main\Domain\Product\ProductNameChanged;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineProductProjection extends ServiceEntityRepository implements ProductProjection
{
    use Projects;

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
    public function projectProductCreated(ProductCreated $event): void
    {
        $this->getEntityManager()->persist(
            Product::reconstituteFrom(new AggregateHistory($event->getAggregateId(), [$event]))
        );
    }

    /**
     * @inheritDoc
     */
    public function projectProductNameChanged(ProductNameChanged $event): void
    {
    }
}
