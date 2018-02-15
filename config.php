<?php
/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

/**
 * Config file
 *
 * Class Config file
 * @package Config File
 */

use Psr\Log\LoggerInterface;
use Monolog\Logger;

return [
    \HotelsFilters\Domain\Contracts\Repository\HotelRepositoryContract::class => DI\object(\HotelsFilters\Persistence\DataTable\HotelRepository::class)
];