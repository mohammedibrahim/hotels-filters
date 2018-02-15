<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Filters;

use HotelsFilters\Domain\Contracts\FiltersContracts\AbstractFilter;
use HotelsFilters\Domain\Exceptions\BadInputFormat;


/**
 * Hotel Name Filter
 *
 * Class NameFilter
 * @package HotelsFilters\Filters
 */
class HotelNameFilter extends AbstractFilter
{
    /**
     * Filter Name.
     *
     * @var string
     */
    protected $filterName = 'hotel_name';

    /**
     * Set Filter Value.
     *
     * @param $value
     * @return $this
     * @throws BadInputFormat
     */
    public function setFilterValue($value)
    {
        if(!is_string($value)){
            throw new BadInputFormat('Hotel Name format must be a string');
        }

        $this->filterValue = $value;

        return $this;
    }

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