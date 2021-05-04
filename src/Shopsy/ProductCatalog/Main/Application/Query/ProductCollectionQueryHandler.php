<?php

namespace App\Shopsy\ProductCatalog\Main\Application\Query;

use App\Common\Application\Query\QueryResult;
use App\Common\Application\Query\QueryHandler;
use App\Shopsy\ProductCatalog\Main\Domain\Product\ProductViewRepository;
use App\Common\Application\Query\DataTransformer\CollectionDataTransformer;

class ProductCollectionQueryHandler implements QueryHandler
{
    /**
     * @var ProductViewRepository
     */
    private ProductViewRepository $productRepository;

    /**
     * @var CollectionDataTransformer
     */
    private CollectionDataTransformer $productCollectionDataTransformer;

    /**
     * @param ProductViewRepository $productRepository
     */
    public function __construct(ProductViewRepository $productRepository, CollectionDataTransformer $productCollectionDataTransformer)
    {
        $this->productRepository = $productRepository;
        $this->productCollectionDataTransformer = $productCollectionDataTransformer;
    }

    /**
     * @param ProductCollectionQuery $query
     *
     * @return Dto[]
     */
    public function __invoke(ProductCollectionQuery $query): QueryResult
    {
        $repositoryQueryResult = $this->productRepository->query(
            $query->getFilter(),
            $query->getPage(),
            $query->getLimit(),
            $query->getSort()
        );

        $this->productCollectionDataTransformer->write(
            $repositoryQueryResult->getResult()
        );

        return new QueryResult(
            $this->productCollectionDataTransformer->read(),
            $repositoryQueryResult->getPage(),
            $repositoryQueryResult->getLimit(),
            $repositoryQueryResult->getTotal()
        );
    }
}
