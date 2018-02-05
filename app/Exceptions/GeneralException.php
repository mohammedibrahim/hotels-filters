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
 * General Exception.
 *
 * Class GeneralException
 * @package HotelsFilters\Exceptions
 */
class GeneralException extends \Exception
{
    protected $code = 400;
}