<?php
/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

require_once 'vendor/autoload.php';

ini_set('display_errors', 1);

error_reporting(E_ALL);

use HotelsFilters\Persistence\Http\HotelController;



$containerBuilder = new \DI\ContainerBuilder();

$containerBuilder->addDefinitions('config.php');

$container = $containerBuilder->build();

$userManager = $container->get(HotelController::class);

