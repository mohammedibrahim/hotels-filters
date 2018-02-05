<?php
/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsUnitTest;

/**
 * Coverage Test case.
 *
 * Class Test
 * @package HotelsUnitTest
 */

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class APITest extends TestCase
{
    protected $client;

    protected $response;

    protected $url = 'http://192.168.2.45/hotels-filters';

    public function setUp()
    {
        $this->client = new Client();
    }

    private function get($data)
    {
        $this->response = $this->client->request('GET', $this->url, ['query' => $data]);
    }

    public function testAPIRequest()
    {
        $this->get([
                'filters[hotel_name]' => 'Ho',
                'filters[price_range]' => '60:80',
                'filters[destination]' => 'Ma',
                'output_format' => 'json'
        ]);

        $response = (string) $this->response->getBody();

        $this->assertArrayHasKey('data', json_decode($response, 1));
    }

}
