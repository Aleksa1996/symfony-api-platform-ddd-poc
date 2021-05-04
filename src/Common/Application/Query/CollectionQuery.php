<?php

namespace App\Common\Application\Query;

class CollectionQuery
{
    /**
     * @var int
     */
    protected int $page;

    /**
     * @var int
     */
    protected int $limit;

    /**
     * @var array
     */
    protected array $filter;

    /**
     * @var array
     */
    protected array $sort;

    /**
     * @param integer $page
     * @param integer $limit
     * @param array $filter
     * @param array $sort
     */
    public function __construct(int $page = 1, int $limit = 10, array $filter = [], array $sort = [])
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->filter = $filter;
        $this->sort = $sort;
    }

    /**
     * @return  int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return  int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return  array
     */
    public function getFilter(): array
    {
        return $this->filter;
    }

    /**
     * @return  mixed
     */
    public function getSort(): array
    {
        return $this->sort;
    }
}
