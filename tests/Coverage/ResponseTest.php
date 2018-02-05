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
use HotelsFilters\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Response Unit Test.
 *
 * Class ResponseTest
 * @package HotelsUnitTest\Coverage
 */
class ResponseTest extends TestCase
{
    protected $response;

    protected $request;

    protected $content;

    public function setUp()
    {
        ob_start();

        $this->request = new Request();

        $this->content = ob_get_contents();

        ob_end_clean();
    }

    public function successProvider()
    {
        $this->setUp();

        $data = json_decode((string) $this->content, 1);

        return [
            [$data, 'json', 200],
        ];
    }

    /**
     * @dataProvider successProvider
     */
    public function test_response_success($data, $outputFormat, $responseCode)
    {
        ob_start();

        new Response($data, $outputFormat, $responseCode);

        $response = ob_get_contents();

        ob_end_clean();

        $response = json_decode($response,1);

        $this->assertArrayHasKey('data', $response);

        $this->assertCount(6, $response['data']);
    }

    /**
     * @dataProvider failureProvider
     */
    public function test_response_failure($data, $outputFormat, $responseCode)
    {
        ob_start();

        new Response($data, $outputFormat, $responseCode);

        $response = ob_get_contents();

        ob_end_clean();

        $response = json_decode($response,1);

        $this->assertArrayHasKey('error', $response);

        $this->assertTrue(is_string($response['error']));
    }

    public function failureProvider()
    {
        return [
            [['error' => ''], 'json', 422],
        ];
    }

}