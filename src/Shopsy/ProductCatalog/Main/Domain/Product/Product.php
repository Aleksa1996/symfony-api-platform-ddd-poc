<?php

namespace App\Shopsy\ProductCatalog\Main\Domain\Product;

use App\Common\Domain\Id;
use App\Common\Domain\Aggregate;
use App\Common\Domain\Event\DomainEvent;
use Verraes\ClassFunctions\ClassFunctions;
use App\Common\Domain\DomainEventRecording;
use App\Common\Domain\Event\AggregateHistory;

class Product extends Aggregate
{
    use DomainEventRecording;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $description;

    /**
     * @param Id $id
     * @param string $name
     * @param string $description
     */
    private function __construct(Id $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return  string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param Id $id
     * @param string $name
     * @param string $description
     *
     * @return static
     */
    public static function create(Id $id, string $name, string $description): static
    {
        $product = new static($id, $name, $description);

        $product->recordThat(
            new ProductCreated($id, $name, $description)
        );

        return $product;
    }

    /**
     * @return static
     */
    private static function createEmpty(): static
    {
        return new static(new Id(), '', '');
    }

    /**
     * @param DomainEvent $domainEvent
     *
     * @return void
     */
    private function apply($domainEvent): void
    {
        $method = 'apply' . ClassFunctions::short($domainEvent);
        $this->$method($domainEvent);
    }

    /**
     * @param DomainEvent $domainEvent
     *
     * @return void
     */
    private function applyAndRecordThat(DomainEvent $domainEvent): void
    {
        $this->recordThat($domainEvent);

        $this->apply($domainEvent);
    }

    /**
     * @param AggregateHistory $aggregateHistory
     *
     * @return static
     */
    public static function reconstituteFrom(AggregateHistory $aggregateHistory)
    {
        $aggregate = static::createEmpty($aggregateHistory->getId());

        foreach ($aggregateHistory->getDomainEvents() as $domainEvent) {
            $aggregate->apply($domainEvent);
        }

        return $aggregate;
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function changeName($name): void
    {
        $this->applyAndRecordThat(
            new ProductNameChanged($this->id, $name)
        );
    }

    /**
     * @param ProductCreated $domainEvent
     *
     * @return void
     */
    private function applyProductCreated(ProductCreated $domainEvent): void
    {
        $this->name = $domainEvent->getName();
        $this->description = $domainEvent->getDescription();
    }

    /**
     * @param ProductNameChanged $domainEvent
     *
     * @return void
     */
    private function applyProductNameChanged(ProductNameChanged $domainEvent): void
    {
        $this->name = $domainEvent->getName();
    }
}
