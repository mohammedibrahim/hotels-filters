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
 * API Client Request exceptions.
 *
 * Class APIClientReuestException
 * @package HotelsFilters\Exceptions
 */
class APIClientRequestException extends \Exception
{
    protected $code = 400;
}