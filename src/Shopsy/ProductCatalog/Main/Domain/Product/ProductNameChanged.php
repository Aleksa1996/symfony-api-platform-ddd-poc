<?php

namespace App\Shopsy\ProductCatalog\Main\Domain\Product;

use DateTimeImmutable;
use App\Common\Domain\Id;
use App\Common\Domain\Event\DomainEvent;
use App\Common\Domain\Event\ImplementsDomainEvent;

class ProductNameChanged implements DomainEvent
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
     * @param Id $id
     * @param string $name
     */
    public function __construct(Id $id, string $name)
    {
        $this->id = $id->getId();
        $this->name = $name;
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
        return 'ProductNameChanged';
    }

    /**
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
