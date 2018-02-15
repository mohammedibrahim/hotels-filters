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

        $key = key($this->data);

        if($key === 'data'){

            $output[$key] = [];

            foreach($this->data[$key] as $row){
                $output[$key][] = $dataMapper->extract($row);
            }

        }else{
            $output[$key] = $this->data[$key];
        }

        return json_encode($output,JSON_PRETTY_PRINT);
    }

}