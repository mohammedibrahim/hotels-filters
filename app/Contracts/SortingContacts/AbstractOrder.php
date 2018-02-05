<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Contracts\SortingContacts;


/**
 * Abstract Order.
 *
 * Class AbstractOrder
 * @package HotelsFilters\Contracts\SortingContacts
 */
abstract class AbstractOrder implements OrderContract
{
    /**
     * Order Key Name.
     *
     * @var string
     */
    protected $orderName = '';

    /**
     * Orde type.
     *
     * @var string
     */
    protected $orderType = 'asc';

    /**
     *
     * @return string
     */
    public function getOrderName(): string
    {
        return $this->orderName;
    }

    /**
     * Set Order Type.
     *
     * @param $orderType
     * @return mixed
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;

        return $this;
    }

    /**
     * Sort Array of data by Key.
     *
     * @param $array
     * @param $column
     * @param string $order
     * @return array
     */
    public function sort(array $array, $column, $order = 'asc'): array
    {
        $return = [];

        $sortedArray = [];

        foreach ($array as $key => $row) {
            $sortedArray[$key] = $row[$column];
        }

        ($order === 'asc') ? asort($sortedArray) : arsort($sortedArray);

        foreach ($sortedArray as $key => $data) {
            $return[] = $array[$key];
        }


        return $return;
    }

}