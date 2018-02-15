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

use HotelsFilters\Domain\Exceptions\OrderNotFoundException;
use HotelsFilters\Domain\Service\StrategyFactory\AbstractStrategy;
use HotelsFilters\Domain\Service\StrategyFactory\OrderStrategy;

/**
 * Orders Repository.
 *
 * Class OrderRepository
 * @package HotelsFilters\Repositories
 */
class OrderService
{
    /**
     * Data to be ordered.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Order Array.
     *
     * @var array
     */
    protected $order = 'name';

    /**
     * @var AbstractStrategy
     */
    protected $orderStrategy;



    /**
     * OrderService constructor.
     * @param $data
     * @param OrderStrategy $orderStrategy
     */
    public function __construct(OrderStrategy $orderStrategy)
    {
        $this->orderStrategy = $orderStrategy;
    }

    /**
     * Set Order
     *
     * @param $order
     * @param $value
     * @return OrderService
     * @throws OrderNotFoundException
     */
    public function setOrder($order, $value): self
    {
        $orderInstance = $this->orderStrategy->getOrderInstance($order);

        $orderInstance->setOrderType($value);

        $this->order = $orderInstance;

        return $this;
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

    /**
     * Set Data
     *
     * @param array $data
     * @return OrderService
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }
}