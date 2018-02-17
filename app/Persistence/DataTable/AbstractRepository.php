<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Persistence\DataTable;

use HotelsFilters\Domain\Contracts\Repository\RepositoryContract;
use HotelsFilters\Domain\Service\FilterService;
use HotelsFilters\Domain\Service\OrderService;
use HotelsFilters\Persistence\Gateway\APIs\APIsClient;
use HotelsFilters\Persistence\Mappers\DataMapper;

/**
 * Abstract Repository.
 *
 * Class HotelRepository
 * @package HotelsFilters\Domain\Repository
 */
class AbstractRepository implements RepositoryContract
{
    /**
     * Gateway.
     *
     * @var gateway
     */
    protected $gateway;

    /**
     * Entity Class
     *
     * @var string
     */
    protected $entityClass;

    /**
     * Data Mapper.
     *
     * @var DataMapper
     */
    protected $dataMapper;

    /**
     * Filter Service
     *
     * @var
     */
    protected $filterService;

    /**
     * Order Service
     *
     * @var
     */
    protected $orderService;

    /**
     * Data.
     *
     * @var
     */
    protected $data = [];

    /**
     * AbstractRepository constructor.
     *
     * @param APIsClient $gateway
     * @param DataMapper $dataMapper
     * @param FilterService $filterService
     * @param OrderService $orderService
     * @throws \HotelsFilters\Domain\Exceptions\APIClientRequestException
     */
    public function __construct(APIsClient $gateway, DataMapper $dataMapper, FilterService $filterService, OrderService $orderService)
    {
        $this->gateway = $gateway;

        $this->dataMapper = $dataMapper;

        $this->filterService = $filterService;

        $this->orderService = $orderService;

        $this->init();
    }

    /**
     * Initialize Request.
     *
     * @throws \HotelsFilters\Domain\Exceptions\APIClientRequestException
     */
    public function init()
    {
        $this->data = json_decode($this->gateway->request()->getResponse(), 1)['hotels'];
    }

    /**
     * Where
     *
     * @param array $conditions
     * @return RepositoryContract
     * @throws \HotelsFilters\Domain\Exceptions\FilterNotFoundException
     */
    public function where(array $conditions): RepositoryContract
    {
        if(empty($conditions)){
            return $this;
        }

        $this->filterService->setData($this->data);

        foreach($conditions as $condition => $value){
            $this->filterService->addFilter($condition, $value);
        }

        $this->data = $this->filterService->applyFilters()->getData();

        return $this;
    }

    /**
     * Order
     *
     * @param string $orderBy
     * @param string $orderType
     * @return RepositoryContract
     * @throws \HotelsFilters\Domain\Exceptions\OrderNotFoundException
     */
    public function order(string $orderBy, string $orderType): RepositoryContract
    {
        $this->data = $this->orderService->setData($this->data)->setOrder($orderBy, $orderType)->applyOrder()->getData();

        return $this;
    }

    /**
     * Get Data.
     * @return array
     */
    public function get(): array
    {
        $data = [];

        foreach($this->data as $row){
            $data[] = $this->dataMapper->hydrate($row);
        }

        $this->data = $data;

        return $this->data;
    }
}