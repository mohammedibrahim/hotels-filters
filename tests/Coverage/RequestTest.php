<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsUnitTest\Coverage;

use HotelsFilters\Http\Request;
use PHPUnit\Framework\TestCase;

/**
 * RequestTest
 *
 * Class RequestTest
 * @package HotelsUnitTest\Coverage
 */
class RequestTest extends TestCase
{
    protected $request;

    protected $content;

    public function setUp()
    {
        $_GET = [];

        ob_start();

        $this->request = new Request();

        $this->content = ob_get_contents();

        ob_end_clean();
    }

    public function test_request_success()
    {
        $response = json_decode($this->content, 1);

        $this->assertArrayHasKey('data', $response);

        $this->assertCount(6, $response['data']);
    }

    public function test_request_failure_output_format()
    {
        $_GET['output_format'] = 'html';

        ob_start();

        $this->request = new Request();

        $this->content = ob_get_contents();

        ob_end_clean();

        $response = json_decode($this->content, 1);

        $this->assertArrayHasKey('error', $response);

        $this->assertTrue(is_string($response['error']));
    }

    public function test_request_failure_filter()
    {
        $_GET['filters'] = [
            'name' => 'Ho'
        ];

        ob_start();

        $this->request = new Request();

        $this->content = ob_get_contents();

        ob_end_clean();

        $response = json_decode($this->content, 1);

        $this->assertArrayHasKey('error', $response);

        $this->assertTrue(is_string($response['error']));
    }

    public function test_request_failure_order()
    {
        $_GET['order_by'] = 'Name';
        $_GET['order_type'] = 'asc';

        ob_start();

        $this->request = new Request();

        $this->content = ob_get_contents();

        ob_end_clean();

        $response = json_decode($this->content, 1);

        $this->assertArrayHasKey('error', $response);

        $this->assertTrue(is_string($response['error']));
    }

    public function test_get_hotels()
    {
        $hotels = $this->request->getHotels();

        $this->assertArrayHasKey('hotels', $hotels);

        $this->assertCount(6, $hotels['hotels']);
    }

    public function test_get_filters_success()
    {
        $_GET['filters'] = ['hotel_name' => 'Ho'];

        $filters = $this->request->getFilters();

        $this->assertTrue(is_array($filters));
    }

    public function test_get_filter_with_data()
    {
        $_GET['filters'] = [
            'hotel_name' => 'ho'
        ];

        $filters = $this->request->getFilters();

        $this->assertTrue(is_array($filters));
    }

    public function test_get_order()
    {
        $orders = $this->request->getOrder();

        $this->assertTrue(is_array($orders));

        $this->assertArrayHasKey('order_by', $orders);

        $this->assertArrayHasKey('order_type', $orders);
    }

    public function test_get_output_format()
    {
        $outputFormat = $this->request->getOutputFormat();

        $this->assertTrue($outputFormat === 'json');
    }

    public function test_get_output_format_with_data()
    {
        $_GET['output_format'] = 'html';

        $outputFormat = $this->request->getOutputFormat();

        $this->assertTrue($outputFormat === 'html');
    }
}
