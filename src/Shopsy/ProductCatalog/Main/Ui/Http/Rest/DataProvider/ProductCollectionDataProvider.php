<?php

namespace App\Shopsy\ProductCatalog\Main\Ui\Http\Rest\DataProvider;

use App\Common\Application\Query\QueryBus;
use ApiPlatform\Core\DataProvider\Pagination;
use App\Shopsy\ProductCatalog\Main\Ui\Http\Rest\Model\Product;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Shopsy\ProductCatalog\Main\Application\Query\Dto\ProductDto;
use App\Shopsy\ProductCatalog\Main\Application\Query\ProductCollectionQuery;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class ProductCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var QueryBus
     */
    private QueryBus $queryBus;

    /**
     * @var Pagination
     */
    private Pagination $pagination;

    /**
     * @param QueryBus $queryBus
     * @param Pagination $pagination
     */
    public function __construct(QueryBus $queryBus, Pagination $pagination)
    {
        $this->queryBus = $queryBus;
        $this->pagination = $pagination;
    }

    /**
     * @param string $resourceClass
     * @param string $operationName
     * @param array $context
     *
     * @return boolean
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Product::class === $resourceClass;
    }

    /**
     * @param string $resourceClass
     * @param string $operationName
     * @param array $context
     *
     * @return iterable
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        list($page, $offset, $limit) = $this->pagination->getPagination($resourceClass, $operationName);
        $result = $this->queryBus->handle(new ProductCollectionQuery($page, $limit));

        $data = [];

        /**
         * @var ProductDto $productDto
         */
        foreach ($result->getResult() as $productDto) {
            $data[] = new Product(
                $productDto->getId(),
                $productDto->getName(),
                $productDto->getDescription()
            );
        }

        return new ProductPaginator(
            $data,
            $result->getPage(),
            $result->getLimit(),
            $result->getTotal()
        );
    }
}
