<?php
namespace App\Shopsy\ProductCatalog\Main\Infrastructure\Persistence\Doctrine\Product;

use App\Common\Domain\Id;
use App\Common\Domain\Event\DomainEventStore;
use App\Shopsy\ProductCatalog\Main\Domain\Product\Product;
use App\Shopsy\ProductCatalog\Main\Domain\Product\ProductProjection;
use App\Shopsy\ProductCatalog\Main\Domain\Product\ProductRepository as ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var DomainEventStore
     */
    private DomainEventStore $domainEventStore;

    /**
     * @var ProductProjection
     */
    private ProductProjection $productProjection;

    /**
     * @param DomainEventStore $domainEventStore
     * @param ProductProjection $productProjection
     */
    public function __construct(DomainEventStore $domainEventStore, ProductProjection $productProjection)
    {
        $this->domainEventStore = $domainEventStore;
        $this->productProjection = $productProjection;
    }
    /**
     * @inheritDoc
     */
    public function findById(Id $id): Product
    {
        $domainEventsHistory = $this->domainEventStore->getAggregateHistoryFor($id);

        return Product::reconstituteFrom($domainEventsHistory);
    }

    /**
     * @inheritDoc
     */
    public function save(Product $product): void
    {
        $domainEvents = $product->getRecordedDomainEvents();

        foreach ($domainEvents as $domainEvent) {
            $this->domainEventStore->append($domainEvent);
        }

        $this->productProjection->project($domainEvents);

        $product->clearRecordedDomainEvents();
    }
}
