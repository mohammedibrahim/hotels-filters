<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Output;

use HotelsFilters\Contracts\OutputFormat\AbstractOutputFormat;

/**
 * Json output format.
 *
 * Class JsonOutput
 * @package HotelsFilters\Contracts\Output
 */
class JsonOutput extends AbstractOutputFormat
{
    protected $formatName = 'json';

    /**
     * @return string
     */
    public function output(): string
    {
        return json_encode($this->data,JSON_PRETTY_PRINT);
    }

}