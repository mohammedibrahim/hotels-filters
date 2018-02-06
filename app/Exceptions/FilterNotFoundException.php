<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Exceptions;

/**
 * Filter Not Found Exception
 *
 * Class FilterNotFoundException
 * @package HotelsFilters\Exceptions
 */
class FilterNotFoundException extends \Exception
{
    /**
     * Error code
     *
     * @var int
     */
    protected $code = 422;
}