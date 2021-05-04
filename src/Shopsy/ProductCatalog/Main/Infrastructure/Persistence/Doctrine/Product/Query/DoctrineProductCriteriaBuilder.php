<?php

namespace App\Shopsy\ProductCatalog\Main\Infrastructure\Persistence\Doctrine\Product\Query;

use App\Common\Infrastructure\Persistence\Doctrine\Query\DoctrineCriteriaBuilder;

class DoctrineProductCriteriaBuilder extends DoctrineCriteriaBuilder
{
    /**
     * @return array
     */
    public function getSupportedFields(): array
    {
        return [
            'name',
            'description'
        ];
    }
}
