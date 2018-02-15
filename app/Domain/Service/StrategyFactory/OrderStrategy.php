<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Service\StrategyFactory;

use HotelsFilters\Domain\Contracts\SortingContacts\OrderContract;
use HotelsFilters\Domain\Exceptions\OrderNotFoundException;
use HotelsFilters\Domain\Orders\NameOrder;
use HotelsFilters\Domain\Orders\PriceOrder;

/**
 * Order Strategy.
 *
 * Class OrderStrategy
 * @package HotelsFilters\Domain\Service\StrategyFactory
 */
class OrderStrategy extends AbstractStrategy
{
    /**
     * Registered Orders.
     *
     * @var array
     */
    protected $registeredOrders = [
        NameOrder::class,
        PriceOrder::class,
    ];

    /**
     * Registered Key.
     *
     * @var array
     */
    protected $registeredOrdersKeys = [];

    /**
     * OrderStrategy constructor.
     */
    public function __construct()
    {
        $this->getRegisteredOrdersNames();
    }

    /**
     * Get Registered Orders Names.
     *
     * @return array
     */
    public function getRegisteredOrdersNames(): array
    {
        $registeredOrders = $this->getRegisteredOrders();

        foreach ($registeredOrders as $registeredOrder) {

            $orderInstance = new $registeredOrder;

            $this->registeredOrdersKeys[$orderInstance->getOrderName()] = $orderInstance;
        }

        return $this->registeredOrdersKeys;
    }

    /**
     * Get Registered Orders
     *
     * @return array
     */
    public function getRegisteredOrders(): array
    {
        return $this->registeredOrders;
    }

    /**
     * Validate Order exists and return instance of it if success.
     *
     * @param $order
     * @return OrderContract
     * @throws OrderNotFoundException
     */
    public function getOrderInstance($order): OrderContract
    {
        if (!isset($this->registeredOrdersKeys[$order])) {
            throw new OrderNotFoundException($order . ' not registered as an order');
        }

        return $this->registeredOrdersKeys[$order];
    }
}