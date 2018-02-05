<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Http;

use HotelsFilters\Http\APIs\APIsClient;
use HotelsFilters\Repositories\HotelRepository;

/**
 * Request.
 *
 * Class Request
 * @package HotelsFilters\Http
 */
class Request
{
    /**
     * Repository.
     *
     * @var HotelRepository
     */
    protected $repo;

    /**
     * Response.
     *
     * @var Response
     */
    protected $response;

    /**
     * Filters
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Order.
     *
     * @var array
     */
    protected $order = [];

    /**
     * Output format
     *
     * @var string
     */
    protected $outputFormat = 'json';

    /**
     * API Client.
     *
     * @var APIsClient
     */
    protected $apiClient;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->apiClient = new APIsClient;

        $this->getRequestParameters();

        $hotels = $this->getHotels();

        try{
            $this->repo = new HotelRepository($this->filters, $this->order, $hotels['hotels']);

            $this->response = new Response( ['data' => $this->repo->getData()], $this->outputFormat);

        }catch (\Exception $e){

            $this->response = new Response( ['error' => $e->getMessage()], $this->outputFormat, $e->getCode());
        }
    }

    /**
     * Get Hotels.
     *
     * @return mixed
     */
    public function getHotels()
    {
        $response = $this->apiClient->request()->getResponse();

        return json_decode($response, true);
    }

    /**
     * Get Request Parameters.
     */
    public function getRequestParameters()
    {
        $this->filters = $this->getFilters();

        $this->order = $this->getOrder();

        $this->outputFormat = $this->getOutputFormat();
    }

    /**
     * Get Filters from Request.
     *
     * @return array
     */
    public function getFilters(): array
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
    public function getOrder(): array
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
    public function getOutputFormat(): string
    {
        if (!empty($_GET['output_format'])) {
            return $_GET['output_format'];
        }

        return 'json';
    }
}