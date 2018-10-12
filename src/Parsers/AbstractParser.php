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
    protected function failIfParsedFileIsEmpty(array $fileData)
    {
        if (empty($fileData)) {
            throw new EmptyFileException('You\'re trying to parse an empty file.');
        }
    }
}
