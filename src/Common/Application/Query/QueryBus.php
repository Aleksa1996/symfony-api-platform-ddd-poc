<?php

namespace App\Common\Application\Query;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    /**
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param object|Envelope $query
     *
     * @return QueryResult The handler returned value
     */
    public function handle($query): QueryResult
    {
        return $this->handleQuery($query);
    }
}
