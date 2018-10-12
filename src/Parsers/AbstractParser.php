<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use Illuminate\Support\Collection;
use MidasSoft\DominicanBankParser\Exceptions\EmptyFileException;
use MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException;

class AbstractParser
{
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
}
