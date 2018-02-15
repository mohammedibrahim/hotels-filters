<?php
/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsUnitTest\APIs;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

/**
 * Coverage Test case.
 *
 * Class Test
 * @package HotelsUnitTest
 */
class APITest extends TestCase
{
    /**
     * Client
     * @var
     */
    protected $client;

    /**
     * Response.
     * @var
     */
    protected $response;

    /**
     * API Url.
     * @var string
     */
    protected $url = 'http://localhost';

    /**
     * Setup
     */
    public function setUp()
    {
        $this->client = new Client();
    }

    /**
     * Make A get api request.
     * @param $data
     */
    private function get($data)
    {
        $this->response = $this->client->request('GET', $this->url, [
            'query' => $data,
            'http_errors' => false
        ]);
    }

    /**
     * Test Filter Name.
     */
    public function test_api_filter_name()
    {
        $this->get([
                'filters[hotel_name]' => 'Ho',
        ]);

        $response = (string) $this->response->getBody();

        $this->assertArrayHasKey('data', json_decode($response, 1));

        $this->assertCount(4, json_decode($response, 1)['data']);
    }

    /**
     * Test filter Pirce
     */
    public function test_api_filter_price()
    {
        $this->get([
            'filters[price_range]' => '60:80',
        ]);

        $response = (string) $this->response->getBody();

        $this->assertArrayHasKey('data', json_decode($response, 1));

        $this->assertCount(1, json_decode($response, 1)['data']);
    }

    /**
     * Test Filter destination.
     */
    public function test_api_filter_destination()
    {
        $this->get([
            'filters[destination]' => 'Cairo',
        ]);

        $response = (string) $this->response->getBody();

        $this->assertArrayHasKey('data', json_decode($response, 1));

        $this->assertCount(1, json_decode($response, 1)['data']);
    }

    /**
     * Test Filter date range.
     */
    public function test_api_filter_date_range()
    {
        $this->get([
            'filters[date_range]' => '25-10-2020:10-11-2020',
        ]);

        $response = (string) $this->response->getBody();

        $this->assertArrayHasKey('data', json_decode($response, 1));

        $this->assertCount(5, json_decode($response, 1)['data']);
    }

    /**
     * Test Oder by name asc
     */
    public function test_api_order_by_name_asc()
    {
        $this->get([
            'order_by' => 'name',
            'order_type' => 'asc'
        ]);

        $response = (string) $this->response->getBody();

        $this->assertArrayHasKey('data', json_decode($response, 1));

        $this->assertEquals('Concorde Hotel', json_decode($response, 1)['data'][0]['name']);
    }

    /**
     * Test Order By name desc.
     */
    public function test_api_order_by_name_desc()
    {
        $this->get([
            'order_by' => 'name',
            'order_type' => 'desc'
        ]);

        $response = (string) $this->response->getBody();

        $this->assertArrayHasKey('data', json_decode($response, 1));

        $this->assertEquals('Rotana Hotel', json_decode($response, 1)['data'][0]['name']);
    }

    /**
     * Test Order by Price asc.
     */
    public function test_api_order_by_price_asc()
    {
        $this->get([
            'order_by' => 'price',
            'order_type' => 'asc'
        ]);

        $response = (string) $this->response->getBody();

        $this->assertArrayHasKey('data', json_decode($response, 1));

        $this->assertEquals('Concorde Hotel', json_decode($response, 1)['data'][0]['name']);
    }

    /**
     * Test Order by price desc.
     */
    public function test_api_order_by_price_desc()
    {
        $this->get([
            'order_by' => 'price',
            'order_type' => 'desc'
        ]);

        $response = (string) $this->response->getBody();

        $this->assertArrayHasKey('data', json_decode($response, 1));

        $this->assertEquals('Novotel Hotel', json_decode($response, 1)['data'][0]['name']);
    }

    /**
     * Tets output format of type json.
     */
    public function test_api_output_format_json()
    {
        $this->get([
            'output_format' => 'json',
        ]);

        $response = (string) $this->response->getBody();

        $response = json_decode($response, 1);

        $this->assertTrue(json_last_error() == JSON_ERROR_NONE);

        $this->assertArrayHasKey('data', $response);

    }

    /**
     * Test when enter a wrong spelling or not exist filter.
     */
    public function test_api_filter_wrong_name()
    {
        $wrongFilterName = 'hotel_namee';

        $this->get([
            'filters['.$wrongFilterName.']' => 'Ho',
        ]);

        $response = (string) $this->response->getBody();

        $responseCode = $this->response->getStatusCode();

        $this->assertEquals(422, $responseCode);

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals($wrongFilterName.' not registered as a filter', $errorMessage);
    }

    /**
     * Test when enter a wrong spelling or not exist order.
     */
    public function test_api_order_wrong_name()
    {
        $wrongOrderName = 'hotel_name_filter';

        $this->get([
            'order_by' => $wrongOrderName,
        ]);

        $response = (string) $this->response->getBody();

        $responseCode = $this->response->getStatusCode();

        $this->assertEquals(422, $responseCode);

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals($wrongOrderName . ' not registered as an order', $errorMessage);
    }

    /**
     * Test when enter a wrong spelling or not exist format type.
     */
    public function test_api_output_wrong_format_type()
    {
        $wrongFormatName = 'html';

        $this->get([
            'output_format' => $wrongFormatName,
        ]);

        $response = (string) $this->response->getBody();

        $responseCode = $this->response->getStatusCode();

        $this->assertEquals(422, $responseCode);

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals($wrongFormatName . ' not registered as an output format', $errorMessage);
    }
}
