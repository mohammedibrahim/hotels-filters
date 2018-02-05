<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Filters;

use HotelsFilters\Contracts\FiltersContracts\AbstractFilter;

/**
 * Price Range Filter.
 *
 * Class PriceRangeFilter
 * @package HotelsFilters\Filters
 */
class PriceRangeFilter extends AbstractFilter
{
    protected $filterName = 'price_range';

    /**
     * Filter Data.
     *
     * @param array $data
     * @return boolean
     */
    public function filterData(array $data): bool
    {
        $filterValue = explode(':',$this->filterValue);

        sort($filterValue);

        list($start, $end) = $filterValue;

        if($start <= $data['price'] && $end >= $data['price']){
            return true;
        }

        return false;
    }
}