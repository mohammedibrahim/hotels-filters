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
 * Hotels Orders Contract
 *
 * Class HotelsOrders
 * @package HotelsFilters\Contracts\SortingContacts
 */
interface OrderContract
{
    /**
     * Get Order By key name.
     *
     * @return mixed
     */
    public function getOrderName(): string;

    /**
     * Order Data.
     *
     * @param array $data
     * @return array
     */
    public function orderData(array $data): array;

    /**
     * Set Order Type.
     *
     * @param $orderType
     * @return mixed
     */
    public function setOrderType($orderType);
}