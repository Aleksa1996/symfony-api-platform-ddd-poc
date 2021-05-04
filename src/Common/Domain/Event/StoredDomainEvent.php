<?php

namespace App\Common\Domain\Event;

use DateTimeImmutable;
use App\Common\Domain\Id;

class StoredDomainEvent
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var Id
     */
    private Id $aggregateId;

    /**
     * @var string
     */
    private string $type;

    /**
     * @var string
     */
    private string $data;

    /**
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $occurredOn;

    /**
     * @param Id $aggregateId
     * @param string $type
     * @param string $data
     * @param DateTimeImmutable $occurredOn
     */
    public function __construct(Id $aggregateId, string $type, string $data, DateTimeImmutable $occurredOn)
    {
        $this->aggregateId = $aggregateId;
        $this->type = $type;
        $this->data = $data;
        $this->occurredOn = $occurredOn;
    }

    /**
     * @return  Id
     */
    public function getAggregateId(): Id
    {
        return $this->aggregateId;
    }

    /**
     * @return  string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return  string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return  DateTimeImmutable
     */
    public function getOccurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
