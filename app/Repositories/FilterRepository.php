<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Repositories;

use HotelsFilters\Contracts\FiltersContracts\FilterContract;
use HotelsFilters\Exceptions\FilterNotFoundException;
use HotelsFilters\Filters\DateRangeFilter;
use HotelsFilters\Filters\DestinationFilter;
use HotelsFilters\Filters\HotelNameFilter;
use HotelsFilters\Filters\PriceRangeFilter;

/**
 * Filters Repository.
 *
 * Class FilterRepository
 * @package HotelsFilters\Repositories
 */
class FilterRepository
{
    protected $registeredFilters = [
        DateRangeFilter::class,
        DestinationFilter::class,
        HotelNameFilter::class,
        PriceRangeFilter::class
    ];

    /**
     * Filters Array.
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
     * Registered Filters Keys.
     * @var array
     */
    protected $registeredFiltersKeys = [];

    /**
     * FilterRepository constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->getRegisteredFiltersNames();

        $this->data = $data;
    }

    /**
     * Get Registered Filter Names.
     *
     * @return array
     */
    public function getRegisteredFiltersNames(): array
    {
        $registeredFilters = $this->getRegisteredFilters();

        foreach($registeredFilters as $registeredFilter){

            $filterInstance = new $registeredFilter;

            $this->registeredFiltersKeys[$filterInstance->getFilterName()] = $filterInstance;
        }

        return $this->registeredFiltersKeys;
    }

    /**
     * Get Registered Filters.
     *
     * @return array
     */
    public function getRegisteredFilters(): array
    {
        return $this->registeredFilters;
    }

    /**
     * Add Filter.
     *
     * @param $filter
     * @param $value
     * @return FilterRepository
     */
    public function addFilter($filter, $value): self
    {
        $filterInstance = $this->getFilterInstance($filter);

        $filterInstance->setFilterValue($value);

        $this->filters[] = $filterInstance;

        return $this;
    }

    /**
     * Validate Filter exists in registered filters and return it in success.
     *
     * @param $filter
     * @return FilterContract
     * @throws FilterNotFoundException
     */
    public function getFilterInstance($filter): FilterContract
    {
        if(!isset($this->registeredFiltersKeys[$filter])){
            throw new FilterNotFoundException($filter. ' not registered as a filter');
        }

        return $this->registeredFiltersKeys[$filter];
    }

    /**
     * Apply filters.
     *
     * @return FilterRepository
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
    public function applyFilter($dataRow, $index)
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

}