<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Persistence\DataTable;

use HotelsFilters\Domain\Contracts\Repository\HotelRepositoryContract;
use HotelsFilters\Domain\Entity\Hotel;

/**
 * Hotel Repository.
 *
 * Class HotelRepository
 * @package HotelsFilters\Domain\Repository
 */
class HotelRepository extends AbstractRepository implements HotelRepositoryContract
{
    /**
     * Hotel Entity.
     *
     * @var
     */
    protected $entityClass = Hotel::class;
}