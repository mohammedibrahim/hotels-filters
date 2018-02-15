<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Filters;

use HotelsFilters\Domain\Contracts\FiltersContracts\AbstractFilter;
use HotelsFilters\Domain\Exceptions\BadInputFormat;

/**
 * Date Range Filter
 *
 * Class DateRangeFilter
 * @package HotelsFilters\Filters
 */
class DateRangeFilter extends AbstractFilter
{
    /**
     * Filter Name.
     *
     * @var string
     */
    protected $filterName = 'date_range';

    /**
     * Set Filter Value.
     *
     * @param $value
     * @return $this
     * @throws BadInputFormat
     */
    public function setFilterValue($value)
    {
        $regex = '/([0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4})\:([0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4})/';

        preg_match($regex, $value,$matches);

        if(count($matches) !== 3){
            throw new BadInputFormat('Date Range format must be dd-mm-YYYY:dd-mm-YYYY');
        }

        $this->filterValue = $value;

        return $this;
    }

    /**
     * Filter Data.
     *
     * @param array $data
     * @return boolean
     */
    public function filterData(array $data): bool
    {
        $filterValue = $this->strToTimeArr(explode(':',$this->filterValue));

        sort($filterValue);

        list($start, $end) = $filterValue;

        $availableTimes = $data['availability'];

        foreach($availableTimes as $availableTime){

            $availableTime = $this->strToTimeArr($availableTime);

            if($start >= $availableTime['from'] && $end <= $availableTime['to']){

                return true;
            }
        }

        return false;
    }

    /**
     * String to time array.
     *
     * @param $arr
     * @return mixed
     */
    private function strToTimeArr($arr)
    {
        foreach($arr as $key => $row){
            $arr[$key] = strtotime($arr[$key]);
        }

        return $arr;
    }
}