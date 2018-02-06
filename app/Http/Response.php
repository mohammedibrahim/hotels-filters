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
     * Output Repo.
     *
     * @var OutputRepository
     */
    protected $outputRepo;

    /**
     * Response constructor.
     *
     * @param $data
     * @param $outputFormat
     * @param int $responseCode
     */
    public function __construct($data, $outputFormat, $responseCode = 200)
    {
        try{
            $this->outputRepo = new OutputRepository($data, $outputFormat);
            $this->responseData = $data;
            http_response_code($responseCode);

        }catch (\Exception $e){

            $outputFormat = 'json';

            $data = ['error' => $e->getMessage()];

            $this->outputRepo = new OutputRepository($data, $outputFormat);

            $this->responseData = $data;

            http_response_code($e->getCode());
        }

        echo $this->outputRepo->getOutputFormat()->output();
    }
}