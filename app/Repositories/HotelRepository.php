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

/**
 * Hotel Repository
 *
 * Class HotelRepository
 * @package HotelsFilters\Contracts\Repositories
 */
class HotelRepository
{
    /**
     * Filter Repo.
     *
     * @var FilterRepository
     */
    protected $filterRepo;

    /**
     * Order Repo.
     *
     * @var OrderRepository
     */
    protected $orderRepo;

    /**
     * Data.
     *
     * @var
     */
    protected $data = [];

    /**
     * HotelRepository constructor.
     *
     * @param $filters
     * @param $order
     * @param $data
     */
    public function __construct($filters, $order, $data)
    {
        $this->filterRepo = new FilterRepository($data);

        $this->addFilters($filters);

        $this->orderRepo = new OrderRepository($this->data);

        $this->addOrder($order['order_by'], $order['order_type']);
    }

    /**
     * Add Filters to Filter Repository.
     *
     * @param array $filters
     * @return mixed
     */
    public function addFilters(array $filters): self
    {
        foreach ($filters as $filter => $value) {
            $this->filterRepo->addFilter($filter, $value);
        }

        $this->data = $this->filterRepo->applyFilters()->getData();

        return $this;
    }

    /**
     * Add Orders to Orders Repository.
     *
     * @param $order
     * @param $orderType
     * @return HotelRepository
     */
    public function addOrder($order, $orderType): self
    {
        $this->orderRepo->setOrder($order, $orderType);

        $this->data = $this->orderRepo->applyOrder()->getData();

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