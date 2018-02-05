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
 * Output Format Exceptions
 *
 * Class OutputFormatNotFoundException
 * @package HotelsFilters\Exceptions
 */
class OutputFormatNotFoundException extends \Exception
{
    protected $code = 422;

}