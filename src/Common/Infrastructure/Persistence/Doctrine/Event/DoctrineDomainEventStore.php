<?php

namespace App\Common\Infrastructure\Persistence\Doctrine\Event;

use App\Common\Domain\Id;
use App\Common\Domain\Event\DomainEvent;
use Doctrine\Persistence\ManagerRegistry;
use App\Common\Domain\Event\AggregateHistory;
use App\Common\Domain\Event\DomainEventStore;
use App\Common\Domain\Event\StoredDomainEvent;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineDomainEventStore extends ServiceEntityRepository implements DomainEventStore
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @param ManagerRegistry $registry
     * @param SerializerInterface $serializer
     */
    public function __construct(ManagerRegistry $registry, SerializerInterface $serializer)
    {
        parent::__construct($registry, StoredDomainEvent::class);
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     */
    public function append(DomainEvent $domainEvent): void
    {
        $storedDomainEvent = new StoredDomainEvent(
            $domainEvent->getAggregateId(),
            $domainEvent->getType(),
            $this->serializer->serialize(
                $domainEvent,
                'json'
            ),
            $domainEvent->getOccurredOn()
        );
        $this->getEntityManager()->persist($storedDomainEvent);
    }

    /**
     * @inheritDoc
     */
    public function getAggregateHistoryFor(Id $id): AggregateHistory
    {
        $storedDomainEvents = $this->findBy(['aggregate_id' => $id]);

        $domainEvents = [];
        foreach ($storedDomainEvents as $storedDomainEvent) {
            $domainEvents[] = $this->serializer->deserialize(
                $storedDomainEvent->getData(),
                $storedDomainEvent->getType(),
                'json'
            );
        }

        return new AggregateHistory($id, $domainEvents);
    }
}
