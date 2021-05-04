<?php

namespace App\Common\Application\Command;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus
{
    /**
     * @var MessageBusInterface
     */
    private MessageBusInterface $messageBus;

    /**
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param object|Envelope $command
     *
     * @return mixed The handler returned value
     */
    public function handle($command)
    {
        return $this->messageBus->dispatch($command);
    }
}
