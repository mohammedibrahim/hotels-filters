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

/**
 * Hotel Service
 *
 * Class HotelService
 * @package HotelsFilters\Contracts\Repositories
 */
class HotelService
{
    /**
     * Data.
     *
     * @var
     */
    protected $data = [];

    public function __construct()
    {}

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
     * Set Data.
     *
     * @param $data
     * @return HotelService
     */
    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }
}