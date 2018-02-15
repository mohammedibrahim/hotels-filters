<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Output;

use HotelsFilters\Domain\Contracts\OutputFormat\AbstractOutputFormat;
use HotelsFilters\Persistence\Mappers\DataMapper;

/**
 * Json output format.
 *
 * Class JsonOutput
 * @package HotelsFilters\Contracts\Output
 */
class JsonOutput extends AbstractOutputFormat
{
    /**
     * Format Name.
     *
     * @var string
     */
    protected $formatName = 'json';

    /**
     * Output Method.
     *
     * @return string
     */
    public function output(): string
    {
        $dataMapper = new DataMapper;
        $output = [];

        foreach($this->data['data'] as $row){
            $output['data'][] = $dataMapper->extract($row);
        }

        return json_encode($output,JSON_PRETTY_PRINT);
    }

}