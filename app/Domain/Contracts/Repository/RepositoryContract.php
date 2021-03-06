<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Contracts\Repository;


/**
 * Main Repository
 *
 * Class RepositoryInterface
 * @package HotelsFilters\Domain\Repository
 */
interface RepositoryContract
{
    /**
     * Conditions
     *
     * @param array $conditions
     * @return RepositoryContract
     */
    public function where(array $conditions): RepositoryContract;

    /**
     * Orders
     *
     * @param $orderBy
     * @param $orderType
     * @return RepositoryContract
     */
    public function order(string $orderBy,string $orderType): RepositoryContract;

    /**
     * Get Data.
     * @return array
     */
    public function get(): array;
}