<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Service;

use HotelsFilters\Domain\Contracts\OutputFormat\OutputContract;
use HotelsFilters\Domain\Service\StrategyFactory\AbstractStrategy;
use HotelsFilters\Domain\Service\StrategyFactory\OutputStrategy;

/**
 * Output Repository.
 *
 * Class OrderRepository
 * @package HotelsFilters\Repositories
 */
class OutputService
{
    /**
     * OutputFormat Array.
     *
     * @var string
     */
    protected $outputFormat = 'json';

    /**
     * Output Strategy.
     *
     * @var AbstractStrategy
     */
    protected $outputStrategy;

    /**
     * OutputService constructor.
     * @param OutputStrategy $outputStrategy
     */
    public function __construct(OutputStrategy $outputStrategy)
    {
        $this->outputStrategy = $outputStrategy;
    }

    /**
     * Return Output Format.
     *
     * @param string $outputFormat
     * @return OutputContract
     * @throws \HotelsFilters\Domain\Exceptions\OutputFormatNotFoundException
     */
    public function getOutputFormat(string $outputFormat): OutputContract
    {
        return $this->outputStrategy->getOutputFormatInstance($outputFormat);
    }
}