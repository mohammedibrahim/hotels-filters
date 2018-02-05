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
 * @package ${NAMESPACE}
 */

use PHPUnit\Framework\TestCase;
use HotelsFilters\Http\Request;
use HotelsFilters\Exceptions\FilterNotFoundException;
use HotelsFilters\Exceptions\OrderNotFoundException;
use HotelsFilters\Exceptions\OutputFormatNotFoundException;

class CoverageTest extends TestCase
{
    public function setUp()
    {
        $_GET = [];
    }

    public function testExistData()
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

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('data', json_decode($response, 1));
    }

    public function testPriceOrder()
    {
        ob_start();

        $_GET['order_by'] = 'price';

        $_GET['order_type'] = 'asc';

        new Request();

        $response = ob_get_contents();

        ob_end_clean();

        $this->assertArrayHasKey('data', json_decode($response, 1));
    }

    public function testNotValidDataForDateRange()
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

    public function testNotValidDataForDestination()
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

    public function testWrongFilterName()
    {
        $this->expectException(FilterNotFoundException::class);

        $_GET['filters'] = [
            'name' => 'Ho',
        ];

        new Request();
    }

    public function testWrongOrderName()
    {
        $this->expectException(OrderNotFoundException::class);

        $_GET['order_by'] = 'Name';

        new Request();
    }

    public function testWrongOutputFormatName()
    {
        $this->expectException(OutputFormatNotFoundException::class);

        $_GET['output_format'] = 'html';

        new Request();
    }

}
