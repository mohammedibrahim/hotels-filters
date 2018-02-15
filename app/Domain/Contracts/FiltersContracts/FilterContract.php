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
 * Filters Contact.
 *
 * Class FilterContract
 * @package HotelsFilters\Contracts\FiltersContracts
 */
interface FilterContract
{
    /**
     * Get Filter Name.
     *
     * @return mixed
     */
     public function getFilterName(): string;

    /**
     * Filter Data.
     *
     * @param array $data
     * @return boolean
     */
     public function filterData(array $data) : bool;

    /**
     * Set Filter Value.
     *
     * @param $value
     * @return $this
     */
     public function setFilterValue($value);
}