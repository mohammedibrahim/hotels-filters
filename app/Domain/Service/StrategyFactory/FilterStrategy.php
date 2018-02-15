<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Service\StrategyFactory;
use HotelsFilters\Domain\Contracts\FiltersContracts\FilterContract;
use HotelsFilters\Domain\Exceptions\FilterNotFoundException;
use HotelsFilters\Domain\Filters\DateRangeFilter;
use HotelsFilters\Domain\Filters\DestinationFilter;
use HotelsFilters\Domain\Filters\HotelNameFilter;
use HotelsFilters\Domain\Filters\PriceRangeFilter;

/**
 * ${DESC}
 *
 * Class FilterStrategy
 * @package HotelsFilters\Domain\Service\StrategyFactory
 */
class FilterStrategy extends AbstractStrategy
{
    protected $registeredFilters = [
        DateRangeFilter::class,
        DestinationFilter::class,
        HotelNameFilter::class,
        PriceRangeFilter::class
    ];

    /**
     * Registered Filters Keys.
     * @var array
     */
    protected $registeredFiltersKeys =[];

    /**
     * FilterStrategy constructor.
     */
    public function __construct()
    {
        $this->getRegisteredFiltersNames();
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
     * Get Registered Filters
     *
     * @return array
     */
    public function getRegisteredFilters(): array
    {
        return $this->registeredFilters;
    }
}