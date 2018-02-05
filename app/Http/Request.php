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
//        $response = '{"hotels":[{"name":"Media One Hotel","price":102.2,"city":"dubai","availability":[{"from":"10-10-2020","to":"15-10-2020"},{"from":"25-10-2020","to":"15-11-2020"},{"from":"10-12-2020","to":"15-12-2020"}]},{"name":"Rotana Hotel","price":80.6,"city":"cairo","availability":[{"from":"10-10-2020","to":"12-10-2020"},{"from":"25-10-2020","to":"10-11-2020"},{"from":"05-12-2020","to":"18-12-2020"}]},{"name":"Le Meridien","price":89.6,"city":"london","availability":[{"from":"01-10-2020","to":"12-10-2020"},{"from":"05-10-2020","to":"10-11-2020"},{"from":"05-12-2020","to":"28-12-2020"}]},{"name":"Golden Tulip","price":109.6,"city":"paris","availability":[{"from":"04-10-2020","to":"17-10-2020"},{"from":"16-10-2020","to":"11-11-2020"},{"from":"01-12-2020","to":"09-12-2020"}]},{"name":"Novotel Hotel","price":111,"city":"Vienna","availability":[{"from":"20-10-2020","to":"28-10-2020"},{"from":"04-11-2020","to":"20-11-2020"},{"from":"08-12-2020","to":"24-12-2020"}]},{"name":"Concorde Hotel","price":79.4,"city":"Manila","availability":[{"from":"10-10-2020","to":"19-10-2020"},{"from":"22-10-2020","to":"22-11-2020"},{"from":"03-12-2020","to":"20-12-2020"}]}]}';

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