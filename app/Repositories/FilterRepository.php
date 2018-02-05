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
        return [
            DateRangeFilter::class,
            DestinationFilter::class,
            HotelNameFilter::class,
            PriceRangeFilter::class
        ];
    }

    /**
     * Add Filter.
     *
     * @param FilterContract $filter
     * @return object
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
     */
    public function applyFilters(): self
    {
        $filteredData = [];

        foreach($this->data as $dataRow){

            $addToFiltered = true;

            foreach($this->filters as $filter){

                if(!$filter->filterData($dataRow)){

                    $addToFiltered = false;

                    break;
                }
            }

            if($addToFiltered){
                $filteredData[] = $dataRow;
            }
        }

        $this->data = $filteredData;

        return $this;
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