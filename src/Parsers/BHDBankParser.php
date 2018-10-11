<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\CSV;
use MidasSoft\DominicanBankParser\Interfaces\ParserInterface;
use MidasSoft\DominicanBankParser\Traits\InteractsWithArrayTrait;
use MidasSoft\DominicanBankParser\Validators\BHDValidator;

class BHDBankParser extends AbstractParser implements ParserInterface
{
    use InteractsWithArrayTrait;

    /**
     * Eliminates unnecesary values into
     * a BHD bank file and convert it
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

        array_walk(array_slice(CSV::sanitize($fileString), 3), function ($line, $key) use (&$fileData) {
            if (!BHDValidator::validate($line)) {
                return;
            }

            $fileData["credit"][] = $line[6]; // amount
            $fileData["date"][] = $line[0]; // date
            $fileData["term"][] = $line[4]; // reference
            $fileData["description"][] = $line[4]; // reference
        });

        $this->failIfIsEmpty($fileData);

        return $this->reverseMultidimensionalArrayValues($fileData);
    }
}
