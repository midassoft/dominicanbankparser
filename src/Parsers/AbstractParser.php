<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Exceptions\EmptyFileException;
use MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException;

class AbstractParser
{
    /**
     * Validates that a file has data to parse.
     *
     * @param array $fileData
     *
     * @throws \MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     *
     * @return void
     */
    protected function failIfIsEmpty(array $fileData)
    {
        if (empty($fileData)) {
            throw new EmptyFileException('You\'re trying to parse an empty file.');
        }
    }

    /**
     * Validates that a value is of type string.
     *
     * @param string $fileString
     *
     * @throws \MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException
     *
     * @return void
     */
    protected function failIfIsNotString($fileString)
    {
        if (!is_string($fileString)) {
            throw new InvalidArgumentException('You have to pass a string as data.');
        }
    }
}
