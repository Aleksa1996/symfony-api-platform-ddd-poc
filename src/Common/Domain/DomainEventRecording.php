<?php

namespace App\Common\Domain;

use App\Common\Domain\Event\DomainEvent;

trait DomainEventRecording
{
    /**
     * @var DomainEvent[]
     */
    protected array $recordedDomainEvents = [];

    /**
     * @return DomainEvent[]
     */
    public function getRecordedDomainEvents(): array
    {
        return $this->recordedDomainEvents;
    }

    /**
     * @return void
     */
    public function clearRecordedDomainEvents(): void
    {
        $this->recordedDomainEvents = [];
    }

    /**
     * @param DomainEvent $domainEvent
     *
     * @return void
     */
    protected function recordThat(DomainEvent $domainEvent): void
    {
        $this->recordedDomainEvents[] = $domainEvent;
    }
}
