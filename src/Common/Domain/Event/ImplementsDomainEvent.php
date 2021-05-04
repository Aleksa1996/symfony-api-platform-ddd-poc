<?php

namespace App\Common\Domain\Event;

use DateTimeImmutable;

trait ImplementsDomainEvent
{
    /**
     * @var int
     */
    private int $version = 1;

    /**
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $occurredOn;

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getOccurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
