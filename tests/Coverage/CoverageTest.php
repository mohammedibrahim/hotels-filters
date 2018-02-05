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

use HotelsFilters\Exceptions\APIClientRequestException;
use HotelsFilters\Http\APIs\APIsClient;
use PHPUnit\Framework\TestCase;
use HotelsFilters\Http\Request;

/**
 * Coverage Test case.
 *
 * Class Test
 * @package HotelsUnitTest
 */
class CoverageTest extends TestCase
{
    /**
     * Set up
     */
    public function setUp()
    {
        $_GET = [];
    }

    /**
     * Happy scenario.
     */
    public function test_happy_scenario()
    {
        ob_start();

        $_GET['filters'] = [
            'hotel_name' => 'Ho',
            'price_range' => '60:80',
            'destination' => 'Ma',
            'date_range' => '25-10-2020:10-11-2020'
        ];
        $_GET['order_by'] = 'name';
        $_GET['order_type'] = 'desc';
        $_GET['output_format'] = 'json';

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('data', json_decode($response, 1));
    }

    /**
     * Price Order
     */
    public function test_price_order()
    {
        ob_start();

        $_GET['order_by'] = 'price';

        $_GET['order_type'] = 'asc';

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('data', json_decode($response, 1));
    }

    /**
     * Not exist data for data range filter.
     */
    public function test_not_exist_data_for_dateRange()
    {
        ob_start();

        $_GET['filters'] = [
            'date_range' => '5-10-2020:10-11-2050'
        ];

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('data', json_decode($response, 1));
    }

    /**
     * Not exsit data with destination filter.
     */
    public function test_not_exist_data_for_destination()
    {
        ob_start();

        $_GET['filters'] = [
            'destination' => 'Ca'
        ];

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('data', json_decode($response, 1));
    }

    /**
     * Wrong name of filter hotel name.
     */
    public function test_wrong_filter_name()
    {
        $wrongName = 'hotel_nameee';

        $_GET['filters'] = [
            $wrongName => 'Ho',
        ];

        ob_start();

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals($wrongName.' not registered as a filter', $errorMessage);
    }

    /**
     * Wrong format of filter hotel name.
     */
    public function test_wrong_filter_name_format()
    {
        $_GET['filters'] = [
            'hotel_name' => 123,
        ];

        ob_start();

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals('Hotel Name format must be a string', $errorMessage);
    }

    /**
     * Wrong Format for filter destination.
     */
    public function test_wrong_filter_destination_format()
    {
        $_GET['filters'] = [
            'destination' => false,
        ];

        ob_start();

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals('Destination format must be a string', $errorMessage);
    }

    /**
     * Wrong Format for filter date range.
     */
    public function test_wrong_filter_date_range_format()
    {
        $_GET['filters'] = [
            'date_range' => 'Ho',
        ];

        ob_start();

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals('Date Range format must be dd-mm-YYYY:dd-mm-YYYY', $errorMessage);
    }

    /**
     * Wrong Format for filter price range.
     */
    public function test_wrong_filter_price_range_format()
    {
        $_GET['filters'] = [
            'price_range' => 'Ho',
        ];

        ob_start();

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals('Price Range format must be 00:00', $errorMessage);
    }

    /**
     * Wrong name for Order Name.
     */
    public function test_wrong_order_name()
    {
        $wrongName = 'hotel_nameee';

        $_GET['order_by'] = $wrongName;

        ob_start();

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals($wrongName.' not registered as an order', $errorMessage);
    }

    /**
     * Wrong value for Order type.
     */
    public function test_wrong_order_type()
    {
        $_GET['order_by'] = 'name';

        $_GET['order_type'] = 'ascc';

        ob_start();

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals('Order type must equal to one of the following: asc, desc', $errorMessage);
    }

    /**
     * Wrong output format name.
     */
    public function test_wrong_output_format()
    {
        $wrongFormat = 'html';

        $_GET['output_format'] = $wrongFormat;

        ob_start();

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('error', json_decode($response, 1));

        $errorMessage = json_decode($response, 1)['error'];

        $this->assertEquals($wrongFormat.' not registered as an output format', $errorMessage);
    }

    /**
     * Test if we used wrong api url it will return exception.
     */
    public function test_api_client_wrong_url()
    {
        $this->expectException(APIClientRequestException::class);

        $apiClient = new APIsClient('wrong-url');

        $apiClient->request();
    }
}
