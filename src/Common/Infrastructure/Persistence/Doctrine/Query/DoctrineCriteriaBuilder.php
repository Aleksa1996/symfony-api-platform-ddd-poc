<?php

namespace App\Common\Infrastructure\Persistence\Doctrine\Query;


use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\Comparison;

abstract class DoctrineCriteriaBuilder
{
    /**
     * @var array
     */
    protected array $filters;

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
    protected array $sort;

    /**
     * @param array $filters
     * @param integer $page
     * @param integer $limit
     * @param array $sort
     */
    public function __construct(array $filters = [], int $page = 1, int $limit = 10, array $sort = [])
    {
        $this->filters = $filters;
        $this->page = abs($page);
        $this->limit = abs($limit);
        $this->sort = $sort;
    }

    /**
     * @return array
     */
    public function getSupportedOperators(): array
    {
        return [
            'in' => Comparison::IN,
            'nin' => Comparison::NIN,
            'ct' => Comparison::CONTAINS,
            'bw' => Comparison::STARTS_WITH,
            'ew' => Comparison::ENDS_WITH,
            'eq' => Comparison::EQ,
            'neq' => Comparison::NEQ,
            'gt' => Comparison::GT,
            'gte' => Comparison::GTE,
            'lt' => Comparison::LT,
            'lte' => Comparison::LTE
        ];
    }

    /**
     * @return array
     */
    public abstract function getSupportedFields(): array;

    /**
     * @param Criteria $criteria
     * @param array $filter
     * @param string $expression
     *
     * @return void
     */
    protected function addExpressionsToCriteria(Criteria $criteria, $filter, $expression = 'and'): void
    {
        $method = $expression === 'or' ? 'orWhere' : 'andWhere';

        if (is_array($filter) && count($filter)) {
            foreach ($filter as $filterKey => $filterValue) {
                if (strtolower($filterKey) === 'or') {
                    $this->addExpressionsToCriteria($criteria, $filterValue, 'or');
                } else if (strtolower($filterKey) === 'and') {
                    $this->addExpressionsToCriteria($criteria, $filterValue, 'and');
                } else if (in_array($filterKey, $this->getSupportedFields(), true)) {
                    if (is_array($filterValue)) {
                        foreach ($filterValue as $o => $value) {
                            if (is_array($value)) {
                                foreach ($value as $v) {
                                    $criteria->$method(new Comparison($filterKey, $this->getSupportedOperators()[$o] ?? Comparison::EQ, $v));
                                }
                            } else {
                                $criteria->$method(new Comparison($filterKey, $this->getSupportedOperators()[$o] ?? Comparison::EQ, $value));
                            }
                        }
                    } else {
                        $criteria->$method(new Comparison($filterKey, Comparison::EQ, $filterValue));
                    }
                } else if (is_array($filterValue)) {
                    $this->addExpressionsToCriteria($criteria, $filterValue, $expression);
                }
            }
        }
    }

    /**
     * @return Criteria
     */
    public function build(): Criteria
    {
        $criteria = Criteria::create();
        $this->addExpressionsToCriteria($criteria, $this->filters);

        if (!empty($this->sort)) {
            $criteria->orderBy(
                array_intersect_key(
                    $this->sort,
                    array_flip($this->getSupportedFields())
                )
            );
        }

        if (!empty($this->page)) {
            $criteria->setFirstResult(abs(($this->page - 1)) * $this->limit);
        }

        if (!empty($this->limit)) {
            $criteria->setMaxResults($this->limit);
        }

        return $criteria;
    }
}
