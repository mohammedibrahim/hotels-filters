<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Persistence\Gateway\APIs;


/**
 * APIs Factory
 *
 * Class APIsFactory
 * @package HotelsFilters\Persistence\Gateway\APIs
 */
class APIsFactory
{
    /**
     * @return APIsClient
     */
    public function createGateway()
    {
        return new APIsClient();
    }
}