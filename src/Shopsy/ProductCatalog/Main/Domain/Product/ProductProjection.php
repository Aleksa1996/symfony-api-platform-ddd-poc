<?php

namespace App\Shopsy\ProductCatalog\Main\Domain\Product;

use App\Common\Domain\Projection;

interface ProductProjection extends Projection
{
    /**
     * @param ProductCreated $event
     *
     * @return void
     */
    public function projectProductCreated(ProductCreated $event): void;

    /**
     * @param ProductNameChanged $event
     *
     * @return void
     */
    public function projectProductNameChanged(ProductNameChanged $event): void;
}
