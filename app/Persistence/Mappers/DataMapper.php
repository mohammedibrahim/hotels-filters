<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Persistence\Mappers;

use HotelsFilters\Domain\Contracts\EntityContract\EntityContract;
use HotelsFilters\Domain\Entity\Hotel;

/**
 * AbstractDataMapper
 *
 * Class AbstractDataMapper
 * @package HotelsFilters\Persistence\Mappers
 */
class DataMapper
{
    protected $entityClass = Hotel::class;

    public function hydrate($data): EntityContract
    {
        $entity = new $this->entityClass;

        $entity->setName($data['name']);
        $entity->setPrice($data['price']);
        $entity->setCity($data['city']);
        $entity->setAvailability($data['availability']);

        return $entity;
    }

    public function extract(EntityContract $hotelEntity): array
    {
        $data = [
            'name' => $hotelEntity->getName(),
            'price' => $hotelEntity->getPrice(),
            'city' => $hotelEntity->getCity(),
            'availability' => $hotelEntity->getAvailability(),
        ];

        return $data;
    }
}