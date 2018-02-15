<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Entity;

use HotelsFilters\Domain\Contracts\EntityContract\AbstractEntity;

/**
 * Hotel Entity
 *
 * Class HotelEntity
 * @package HotelsFilters\Domain\Entity
 */
class Hotel extends AbstractEntity {

    /**
     * Hotel Name.
     *
     * @var
     */
    protected $name;

    /**
     * Price
     *
     * @var
     */
    protected $price;

    /**
     * City
     *
     * @var
     */
    protected $city;

    /**
     * Availability
     *
     * @var
     */
    protected $availability;

    /**
     * Set Name.
     *
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Get Name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get Price.
     *
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set Price.
     *
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * Get City.
     *
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set City.
     *
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * Get Availability.
     *
     * @return mixed
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set Availability.
     *
     * @param mixed $availability
     */
    public function setAvailability($availability): void
    {
        $this->availability = $availability;
    }
}