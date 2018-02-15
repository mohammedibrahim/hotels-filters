<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Domain\Service\StrategyFactory;

use HotelsFilters\Domain\Contracts\OutputFormat\OutputContract;
use HotelsFilters\Domain\Exceptions\OutputFormatNotFoundException;
use HotelsFilters\Domain\Output\JsonOutput;

/**
 * OutputStrategy
 *
 * Class OutputStrategy
 * @package HotelsFilters\Domain\Service\StrategyFactory
 */
class OutputStrategy extends AbstractStrategy
{
    /**
     * Registered Output Format.
     *
     * @var array
     */
    protected $registeredOutputFormats = [
        JsonOutput::class
    ];

    /**
     * Output Format Instance.
     *
     * @var OutputContract
     */
    protected $outputFormatInstance;

    /**
     * Registered Key.
     *
     * @var array
     */
    protected $registeredOutputsKeys = [];

    /**
     * OutputStrategy constructor.
     */
    public function __construct()
    {
        $this->getRegisteredOutputsNames();
    }

    /**
     * Get Registered Orders Names.
     *
     * @return array
     */
    public function getRegisteredOutputsNames(): array
    {
        $registeredOutputs = $this->getRegisteredOutputFormats();

        foreach ($registeredOutputs as $registeredOutput) {

            $outputFormatInstance = new $registeredOutput;

            $this->registeredOutputsKeys[$outputFormatInstance->getFormatName()] = $outputFormatInstance;
        }

        return $this->registeredOutputsKeys;
    }

    /**
     * Get Registered Output Format.
     *
     * @return array
     */
    public function getRegisteredOutputFormats(): array
    {
        return $this->registeredOutputFormats;
    }

    /**
     * Return Instance of output format.
     *
     * @param $outputFormat
     * @return OutputContract
     * @throws OutputFormatNotFoundException
     */
    public function getOutputFormatInstance($outputFormat): OutputContract
    {
        if (!isset($this->registeredOutputsKeys[$outputFormat])) {
            throw new OutputFormatNotFoundException($outputFormat . ' not registered as an output format');
        }

        return $this->registeredOutputsKeys[$outputFormat];
    }
}