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
 * DestinationFilter
 *
 * Class Destination
 * @package HotelsFilters\Filters
 */
class DestinationFilter extends AbstractFilter
{
    /**
     * Filter Name.
     *
     * @var string
     */
    protected $filterName = 'destination';

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
            throw new BadInputFormat('Destination format must be a string');
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

        if($filterValue && strpos(strtolower($data['city']), strtolower($filterValue)) === false ){
            return false;
        }

        return true;
    }
}