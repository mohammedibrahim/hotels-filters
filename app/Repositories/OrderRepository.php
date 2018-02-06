<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Repositories;

use HotelsFilters\Contracts\SortingContacts\OrderContract;
use HotelsFilters\Exceptions\OrderNotFoundException;
use HotelsFilters\Orders\NameOrder;
use HotelsFilters\Orders\PriceOrder;

/**
 * Orders Repository.
 *
 * Class OrderRepository
 * @package HotelsFilters\Repositories
 */
class OrderRepository
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
     * Order Array.
     *
     * @var array
     */
    protected $order = 'name';

    /**
     * Data to be ordered.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Registered Key.
     *
     * @var array
     */
    protected $registeredOrdersKeys = [];

    /**
     * OrderRepository constructor.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->getRegisteredOrdersNames();

        $this->data = $data;
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
     * Set Order.
     *
     * @param $order
     * @param $value
     * @return OrderRepository
     */
    public function setOrder($order, $value): self
    {
        $orderInstance = $this->getOrderInstance($order);

        $orderInstance->setOrderType($value);

        $this->order = $orderInstance;

        return $this;
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

    /**
     * Apply orders.
     */
    public function applyOrder(): self
    {
        $this->data = $this->order->orderData($this->data);

        return $this;
    }

    /**
     * Get Data.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}