<?php

namespace App\Shopsy\ProductCatalog\Main\Domain\Product;

use DateTimeImmutable;
use App\Common\Domain\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;

class ProductCreated implements DomainEvent
{
    use ImplementsDomainEvent;

    /**
     * @var Id
     */
    private Id $id;

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
    public function __construct(Id $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->occurredOn = new DateTimeImmutable();
    }

    /**
     * @return Id
     */
    public function getAggregateId(): Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'ProductCreated';
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
}
