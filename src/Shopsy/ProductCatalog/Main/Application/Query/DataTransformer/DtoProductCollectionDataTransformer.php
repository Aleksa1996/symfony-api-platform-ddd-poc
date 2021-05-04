<?php

namespace App\Shopsy\ProductCatalog\Main\Application\Query\DataTransformer;

use App\Shopsy\ProductCatalog\Main\Domain\Product\Product;
use App\Shopsy\ProductCatalog\Main\Application\Query\Dto\ProductDto;
use App\Common\Application\Query\DataTransformer\CollectionDataTransformer;

class DtoProductCollectionDataTransformer implements CollectionDataTransformer
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param array $entities
     *
     * @return void
     */
    public function write($entities)
    {
        $this->data = [];

        /**
         * @var Product $entity
         */
        foreach ($entities as $entity) {

            $this->data[] = new ProductDto(
                $entity->getId()->getId(),
                $entity->getName(),
                $entity->getDescription()
            );
        }
    }

    /**
     * @return array
     */
    public function read(): array
    {
        return $this->data;
    }
}
