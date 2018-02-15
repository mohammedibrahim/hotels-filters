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

use HotelsFilters\Domain\Service\OutputService;
use HotelsFilters\Repositories\OutputRepository;

/**
 * Response
 *
 * Class Response
 * @package HotelsFilters\Http
 */
class Response
{
    /**
     * Response Data.
     *
     * @var array
     */
    protected $responseData;

    /**
     * Output Format.
     *
     * @var string
     */
    protected $outputFormat = 'json';

    /**
     * Data
     *
     * @var
     */
    protected $data;

    /**
     * Response code.
     *
     * @var int
     */
    protected $responseCode = 200;

    /**
     * Output Service.
     *
     * @var
     */
    protected $outputService;

    /**
     * Response constructor.
     * @param OutputService $outputService
     */
    public function __construct(OutputService $outputService)
    {
        $this->outputService = $outputService;
    }

    /**
     * Output Result.
     *
     * @return mixed
     * @throws \HotelsFilters\Domain\Exceptions\OutputFormatNotFoundException
     */
    public function output()
    {
        try{
            $format = $this->outputService->getOutputFormat($this->outputFormat)->setData($this->data);

            http_response_code($this->responseCode);

        }catch (\Exception $e){

            $this->data = ['error' => $e->getMessage()];

            $format = $this->outputService->getOutputFormat('json')->setData($this->data);

            http_response_code($e->getCode());
        }

        return $format->output();
    }

    /**
     * Set Data.
     *
     * @param $data
     * @return Response
     */
    public function setData($data): Response
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Set Output format.
     *
     * @param string $outputFormat
     * @return Response
     */
    public function setOutputFormat(string $outputFormat): Response
    {
        $this->outputFormat = $outputFormat;

        return $this;
    }

    /**
     * Set Response Code.
     *
     * @param int $responseCode
     * @return Response
     */
    public function setResponseCode(int $responseCode): Response
    {
        $this->responseCode = $responseCode;

        return $this;
    }

}