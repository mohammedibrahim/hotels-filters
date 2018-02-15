<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Service;

use HotelsFilters\Domain\Service\StrategyFactory\AbstractStrategy;
use HotelsFilters\Domain\Service\StrategyFactory\FilterStrategy;

/**
 * Filters Service.
 *
 * Class FilterService
 * @package HotelsFilters\Repositories
 */
class FilterService
{
    /**
     * Filters Array.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Data to be filtered.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Filter Strategy.
     *
     * @var AbstractStrategy
     */
    protected $filterStrategy;

    /**
     * FilterService constructor.
     *
     * @param FilterStrategy $filterStrategy
     */
    public function __construct(FilterStrategy $filterStrategy)
    {
        $this->filterStrategy = $filterStrategy;
    }

    /**
     * Add Filter
     *
     * @param $filter
     * @param $value
     * @return FilterService
     * @throws \HotelsFilters\Domain\Exceptions\FilterNotFoundException
     */
    public function addFilter($filter, $value): self
    {
        $filterInstance = $this->filterStrategy->getFilterInstance($filter);

        $filterInstance->setFilterValue($value);

        $this->filters[] = $filterInstance;

        return $this;
    }

    /**
     * Apply filters.
     *
     * @return FilterService
     */
    public function applyFilters(): self
    {
        foreach($this->data as $index =>$dataRow){

            $this->applyFilter($dataRow, $index);
        }

        return $this;
    }

    /**
     * Apply Filter for each data row.
     *
     * @param $dataRow
     * @param $index
     */
    private function applyFilter($dataRow, $index)
    {
        foreach($this->filters as $filter){

            if(!$filter->filterData($dataRow)){

                unset($this->data[$index]);

                break;
            }
        }
    }

    /**
     * Get Data.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Set Data
     *
     * @param array $data
     * @return FilterService
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }
}