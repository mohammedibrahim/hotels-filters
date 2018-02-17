<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Persistence\Http;

use HotelsFilters\Domain\Contracts\Repository\HotelRepositoryContract;

/**
 * Hotel Controller.
 *
 * Class Request
 * @package HotelsFilters\Http
 */
class HotelController
{
    /**
     * Hotel Repository.
     *
     * @var HotelRepositoryContract
     */
    protected $hotelRepository;

    /**
     * Response.
     *
     * @var Response
     */
    protected $response;

    /**
     * HotelController constructor.
     *
     * @param Response $response
     * @param HotelRepositoryContract $hotelRepository
     */
    public function __construct(Response $response, HotelRepositoryContract $hotelRepository)
    {

        $this->response = $response;

        $this->hotelRepository = $hotelRepository;

        $this->response->setOutputFormat($this->getOutputFormat());

        $this->indexAction();
    }

    /**
     * Index Action
     */
    public function indexAction()
    {
        try{
            $order = $this->getOrder();

            $data = $this->hotelRepository->where($this->getFilters())->order($order['order_by'], $order['order_type'])->get();

            $this->response->setData(['data' => $data]);

        }catch (\Exception $e){

            $this->response->setData(['error' => $e->getMessage()]);

            $this->response->setResponseCode($e->getCode());
        }

        echo $this->response->output();
    }

    /**
     * Get Filters from Request.
     *
     * @return array
     */
    private function getFilters(): array
    {
        $filters = [];

        if (!empty($_GET['filters'])) {
            $filters =  $_GET['filters'];
        }

        return $filters;
    }

    /**
     * Get Orders.
     *
     * @return array
     */
    private function getOrder(): array
    {
        $order = [];

        $order['order_by'] = !empty($_GET['order_by']) ? $_GET['order_by'] : 'name';
        $order['order_type'] = !empty($_GET['order_type']) ? $_GET['order_type'] : 'asc';

        return $order;
    }

    /**
     * Get Format.
     *
     * @return string
     */
    private function getOutputFormat(): string
    {
        if (!empty($_GET['output_format'])) {
            return $_GET['output_format'];
        }

        return 'json';
    }
}