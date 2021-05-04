<?php

namespace App\Common\Domain\Event;

use App\Common\Domain\Id;

interface DomainEventStore
{
    /**
     * @param DomainEvent $domainEvent
     *
     * @return void
     */
    public function append(DomainEvent $domainEvent): void;

    /**
     * @param Id $id
     *
     * @return AggregateHistory
     */
    public function getAggregateHistoryFor(Id $id): AggregateHistory;
}
