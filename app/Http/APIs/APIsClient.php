<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Http\APIs;

use GuzzleHttp\Client;
use HotelsFilters\Exceptions\APIClientRequestException;

/**
 * Web service client for retrive Hotels.
 *
 * Class APIsClient
 * @package HotelsFilters\Http\APIs
 */
class APIsClient
{
    /**
     * Client
     *
     * @var Client
     */
    protected $client;

    /**
     * Response
     *
     * @var
     */
    protected $response;

    /**
     * API Url.
     *
     * @var string
     */
    protected $url;

    /**
     * APIsClient constructor.
     */
    public function __construct($url = 'https://api.myjson.com/bins/tl0bp')
    {
        $this->url = $url;

        $this->client = new Client();
    }

    /**
     * Make a request
     *
     * @return APIsClient
     * @throws APIClientRequestException
     */
    public function request(): self
    {
        try {
            $response = $this->client->request('GET', $this->url);

            $this->response = (string)$response->getBody();

        }catch (\Exception $e){

            throw new APIClientRequestException('Something went wrong with API Request.');
        }

        return $this;
    }

    /**
     * Get Response.
     *
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }
}