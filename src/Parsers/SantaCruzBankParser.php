<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\CSV;
use MidasSoft\DominicanBankParser\Interfaces\ParserInterface;
use MidasSoft\DominicanBankParser\Validators\SantaCruzValidator;

class SantaCruzBankParser extends AbstractParser implements ParserInterface
{
    /**
     * Eliminates unnecesary values into
     * a Santa Cruz bank file and convert it
     * to array.
     *
     * @param string $fileString
     *
     * @throws \MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException
     * @throws \MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     *
     * @return array
     */
    public function parse($fileString)
    {
        $this->failIfIsNotString($fileString);

        $fileData = [];

        array_walk(array_slice(CSV::sanitize($fileString), 1), function ($line, $key) use (&$fileData) {
            if (!SantaCruzValidator::validate($line)) {
                return;
            }

            $fileData['credit'][] = $line[3]; // amount
            $fileData['date'][] = $line[0]; // date
            $fileData['term'][] = $line[1]; // description
            $fileData['description'][] = $line[1]; // description
        });

        $this->failIfIsEmpty($fileData);

        return $fileData;
    }
}
