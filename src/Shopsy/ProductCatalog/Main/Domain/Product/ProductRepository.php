<?php

namespace App\Shopsy\ProductCatalog\Main\Domain\Product;

use App\Common\Domain\Id;
use App\Shopsy\ProductCatalog\Main\Domain\Product\Product;

interface ProductRepository
{
    /**
     * @param Id $id
     *
     * @return Product
     */
    public function findById(Id $id): Product;

    /**
     * @param Product $product
     *
     * @return void
     */
    public function save(Product $product): void;
}
