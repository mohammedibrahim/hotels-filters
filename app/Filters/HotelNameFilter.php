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
 * Hotel Name Filter
 *
 * Class NameFilter
 * @package HotelsFilters\Filters
 */
class HotelNameFilter extends AbstractFilter
{
    protected $filterName = 'hotel_name';

    /**
     * Filter Data.
     *
     * @param array $data
     * @return boolean
     */
    public function filterData(array $data): bool
    {
        $filterValue = $this->filterValue;

        if($filterValue && strpos(strtolower($data['name']), strtolower($filterValue)) === false ){
            return false;
        }

        return true;
    }
}