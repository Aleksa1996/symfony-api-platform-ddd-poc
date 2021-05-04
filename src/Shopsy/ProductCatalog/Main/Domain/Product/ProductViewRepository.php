<?php

namespace App\Shopsy\ProductCatalog\Main\Domain\Product;

use App\Common\Domain\Id;
use App\Common\Domain\RepositoryQueryResult;

interface ProductViewRepository
{
    /**
     * @param Id $id
     *
     * @return Product
     */
    public function findById(Id $id): Product;

    /**
     * @param string $name
     *
     * @return Product
     */
    public function findByName(string $name): Product;

    /**
     * @param array $filters
     * @param integer $page
     * @param integer $limit
     * @param array $sort
     *
     * @return RepositoryQueryResult
     */
    public function query(array $filters = [], int $page = 1, int $limit = 10, array $sort = []): RepositoryQueryResult;
}
