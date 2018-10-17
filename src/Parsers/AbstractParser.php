<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use Illuminate\Support\Collection;
use MidasSoft\DominicanBankParser\Exceptions\EmptyFileException;
use MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException;
use MidasSoft\DominicanBankParser\Interfaces\CacheInterface;

class AbstractParser
{
    /**
     * CacheInterface instance.
     *
     * @var \MidasSoft\DominicanBankParser\Interfaces\CacheInterface
     */
    protected $cacheManager = null;

    /**
     * Validates that a file has data to parse.
     *
     * @param \Illuminate\Support\Collection $fileData
     *
     * @throws \MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     *
     * @return void
     */
    protected function failIfParsedFileIsEmpty(Collection $fileData)
    {
        if (count($fileData) == 0) {
            throw new EmptyFileException('You\'re trying to parse an empty file.');
        }
    }

    /**
     * Returns the cacheManager property.
     *
     * @return \MidasSoft\DominicanBankParser\Interfaces\CacheInterface
     */
    public function getCacheManager()
    {
        return $this->cacheManager;
    }

    /**
     * Returns the cacheManager property.
     *
     * @param \MidasSoft\DominicanBankParser\Interfaces\CacheInterface
     *
     * @return void
     */
    public function setCacheManager(CacheInterface $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }
}
