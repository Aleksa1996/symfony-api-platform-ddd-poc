<?php

namespace App\Shopsy\ProductCatalog\Main\Ui\Http\Rest\DataPersister;

use App\Common\Application\Command\CommandBus;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use App\Shopsy\ProductCatalog\Main\Ui\Http\Rest\Model\Product;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Shopsy\ProductCatalog\Main\Application\Command\CreateProductCommand;

final class ProductDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var CommandBus
     */
    private CommandBus $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @inheritDoc
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Product;
    }

    /**
     * @param Product $data
     * @param array $context
     *
     * @return void
     */
    public function persist($data, array $context = [])
    {
        $envelope = $this->commandBus->handle(
            new CreateProductCommand($data->name, $data->description)
        );

        $handledStamps = $envelope->all(HandledStamp::class);
        $data->id = $handledStamps[0]->getResult() ?? '';

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}
