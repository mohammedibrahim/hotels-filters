<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Filters;

use HotelsFilters\Contracts\FiltersContracts\AbstractFilter;

/**
 * Date Range Filter
 *
 * Class DateRangeFilter
 * @package HotelsFilters\Filters
 */
class DateRangeFilter extends AbstractFilter
{
    protected $filterName = 'date_range';

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