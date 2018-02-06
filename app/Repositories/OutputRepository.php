<?php

/**
 * Hotels Filters
 *
 * @package     Hotels Filters
 * @author      Mohamed Ibrahim <m@mibrah.im>
 * @version     v.1.0 (02/02/2018)
 * @copyright   Copyright (c) 2018
 */

namespace HotelsFilters\Repositories;

use HotelsFilters\Contracts\OutputFormat\OutputContract;
use HotelsFilters\Exceptions\OutputFormatNotFoundException;
use HotelsFilters\Output\JsonOutput;

/**
 * Output Repository.
 *
 * Class OrderRepository
 * @package HotelsFilters\Repositories
 */
class OutputRepository
{
    protected $registeredOutputFormats = [
        JsonOutput::class
    ];
    /**
     * OutputFormat Array.
     *
     * @var string
     */
    protected $outputFormat = 'json';

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
     * Output Format Repository.
     *
     * OutputRepository constructor.
     * @param $data
     * @param $outputFormat
     */
    public function __construct($data, $outputFormat)
    {
        $this->getRegisteredOutputsNames();

        $this->outputFormatInstance = $this->getOutputFormatInstance($outputFormat);

        $this->outputFormatInstance->setData($data);
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
     * Return Output Format
     *
     * @return OutputContract
     */
    public function getOutputFormat(): OutputContract
    {
        return $this->outputFormatInstance;
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