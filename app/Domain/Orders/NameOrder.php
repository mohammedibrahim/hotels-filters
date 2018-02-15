<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Orders;

use HotelsFilters\Domain\Contracts\SortingContacts\AbstractOrder;

/**
 * Order By Hotel Name.
 *
 * Class HotelNameOrder
 * @package HotelsFilters\Orders
 */
class NameOrder extends AbstractOrder
{
    /**
     * Order Name.
     *
     * @var string
     */
    protected $orderName = 'name';

    /**
     * Order Data.
     *
     * @param array $data
     * @return array
     */
    public function orderData(array $data): array
    {
        return $this->sort($data, 'name', $this->orderType);
    }

}