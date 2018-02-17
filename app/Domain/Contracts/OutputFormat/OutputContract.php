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
 * Output Contract.
 *
 * Interface OutputContract
 * @package HotelsFilters\Contracts\OutputFormat
 */
interface OutputContract
{
    /**
     * Get Format Name
     *
     * @return string
     */
    public function getFormatName(): string;

    /**
     * Set Data.
     *
     * @param array $data
     * @return mixed
     */
    public function setData(array $data);

    /**
     * Format Output.
     *
     * @param array $data
     * @return array
     */
    public function output(): string;
}