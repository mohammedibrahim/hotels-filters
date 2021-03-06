<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Contracts\FiltersContracts;

/**
 * AbstractFilter
 *
 * Class AbstractFilter
 * @package HotelsFilters\Contracts\FiltersContracts
 */
abstract class AbstractFilter implements FilterContract
{
    /**
     * Filter Name.
     *
     * @var string
     */
    protected $filterName = '';

    /**
     * Filter Value.
     *
     * @var string
     */
    protected $filterValue = '';

    /**
     * Get Filter Name.
     * @return string
     */
    public function getFilterName(): string
    {
        return $this->filterName;
    }
}