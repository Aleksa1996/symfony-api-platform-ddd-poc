<?php
namespace App\Common\Domain\Event;

use App\Common\Domain\Id;

class AggregateHistory
{
    /**
     * @var Id
     */
    private Id $id;

    /**
     * @var array
     */
    private array $domainEvents;

    /**
     * @param Id $id
     * @param array $domainEvents
     */
    public function __construct(Id $id, array $domainEvents)
    {
        $this->id = $id;
        $this->domainEvents = $domainEvents;
    }

    /**
     * @return  Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return  DomainEvent[]
     */
    public function getDomainEvents(): array
    {
        return $this->domainEvents;
    }
}
