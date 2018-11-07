<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use DateTime;
use DateTimeZone;
use MidasSoft\DominicanBankParser\Cache\AbstractCacheDriver;
use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Exceptions\EmptyFileException;
use MidasSoft\DominicanBankParser\Interfaces\ParserInterface;

abstract class AbstractParser implements ParserInterface
{
    /**
     * AbstractCacheDriver instance.
     *
     * @var \MidasSoft\DominicanBankParser\Cache\AbstractCacheDriver
     */
    protected $cacheManager;

    /**
     * Sends a value to the cache manager.
     *
     * @param $data
     * @return void
     */
    public function cache($data)
    {
        if (!is_null($this->cacheManager)) {
            $timezone = $this->cacheManager->getConfigKey('timezone') ?? 'America/Santo_Domingo';
            $key = (new DateTime('now', new DateTimeZone($timezone)))->format('Y-m-d H:i:s');

            $this->cacheManager->add($key, $data);
        }
    }

    /**
     * Validates that a file has data to parse.
     *
     * @param \MidasSoft\DominicanBankParser\Collections\DepositCollection $fileData
     *
     * @throws \MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     *
     * @return void
     */
    protected function failIfParsedFileIsEmpty(DepositCollection $fileData)
    {
        if (count($fileData) == 0) {
            throw new EmptyFileException('You\'re trying to parse an empty file.');
        }
    }

    /**
     * Returns the cacheManager property.
     *
     * @return \MidasSoft\DominicanBankParser\Cache\AbstractCacheDriver
     */
    public function getCacheManager()
    {
        return $this->cacheManager;
    }

    /**
     * Returns the cacheManager property.
     *
     * @param \MidasSoft\DominicanBankParser\Cache\AbstractCacheDriver
     *
     * @return void
     */
    public function setCacheManager(AbstractCacheDriver $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }
}
