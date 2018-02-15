<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Contracts\OutputFormat;


/**
 * Output Abstract Class
 *
 * Class AbstractOutputFormat
 * @package HotelsFilters\Contracts\OutputFormat
 */
abstract class AbstractOutputFormat implements OutputContract
{
    /**
     * Format Name.
     *
     * @var string
     */
    protected $formatName = 'json';

    /**
     * Data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Set Data.
     *
     * @param array $data
     * @return mixed
     */
    public function setData(array $data): OutputContract
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get Format Name.
     *
     * @return string
     */
    public function getFormatName(): string
    {
        return $this->formatName;
    }
}