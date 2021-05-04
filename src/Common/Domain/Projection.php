<?php

namespace App\Common\Domain;


use App\Common\Domain\Event\DomainEvent;

interface Projection
{
    /**
     * @param DomainEvent[] $domainEvents
     *
     * @return void
     */
    public function project(array $domainEvents): void;
}
