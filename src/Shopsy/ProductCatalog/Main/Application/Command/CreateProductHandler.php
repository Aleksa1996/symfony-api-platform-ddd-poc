<?php

namespace App\Shopsy\ProductCatalog\Main\Application\Command;

use App\Common\Application\Command\CommandHandler;
use App\Common\Domain\Id;
use App\Shopsy\ProductCatalog\Main\Domain\Product\Product;
use App\Shopsy\ProductCatalog\Main\Domain\Product\ProductRepository;

class CreateProductHandler implements CommandHandler
{
    /**
     * @var ProductRepository
     */
    private ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param CreateProductCommand $command
     *
     * @return string
     */
    public function __invoke(CreateProductCommand $command): string
    {
        $product = Product::create(
            $id = new Id(),
            $command->getName(),
            $command->getDescription()
        );

        $this->productRepository->save(
            $product
        );

        return $id->getId();
    }
}
