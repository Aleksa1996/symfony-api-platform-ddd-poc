<?php

namespace App\Common\Domain\Event;

use DateTimeImmutable;
use App\Common\Domain\Id;

interface DomainEvent
{
    /**
     * @return int
     */
    public function getVersion(): int;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return \DateTimeImmutable
     */
    public function getOccurredOn(): DateTimeImmutable;

    /**
     * @return Id
     */
    public function getAggregateId(): Id;
}
