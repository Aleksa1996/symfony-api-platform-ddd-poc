<?php

namespace App\Shopsy\ProductCatalog\Main\Ui\Http\Rest\DataProvider;

use ArrayIterator;
use App\Common\Application\Query\QueryResult;
use ApiPlatform\Core\DataProvider\PaginatorInterface;

class ProductPaginator implements PaginatorInterface, \IteratorAggregate
{
    /**
     * @var ArrayIterator
     */
    private $iterator;

    /**
     * @var array
     */
    private array $result;

    /**
     * @var int
     */
    private int $page;

    /**
     * @var int
     */
    private int $limit;

    /**
     * @var int
     */
    private int $total;

    /**
     * @param array $result
     * @param integer $page
     * @param integer $limit
     * @param integer $total
     */
    public function __construct(array $result, int $page, int $limit, int $total)
    {
        $this->result = $result;
        $this->page = $page;
        $this->limit = $limit;
        $this->total = $total;
    }

    /**
     * @param QueryResult $queryResult
     *
     * @return static
     */
    public static function createFromQueryResult(QueryResult $queryResult)
    {
        return new static($queryResult->getResult(), $queryResult->getPage(), $queryResult->getLimit(), $queryResult->getTotal());
    }

    /**
     * @return float
     */
    public function getLastPage(): float
    {
        return ceil($this->getTotalItems() / $this->getItemsPerPage()) ?: 1.;
    }

    /**
     * @return float
     */
    public function getTotalItems(): float
    {
        return $this->total;
    }

    /**
     * @return float
     */
    public function getCurrentPage(): float
    {
        return $this->page;
    }

    /**
     * @return float
     */
    public function getItemsPerPage(): float
    {
        return $this->limit;
    }

    /**
     * @return float
     */
    public function count()
    {
        return $this->getTotalItems();
    }

    /**
     * @return void
     */
    public function getIterator()
    {
        if ($this->iterator === null) {
            $this->iterator = new ArrayIterator($this->result);
        }

        return $this->iterator;
    }
}
