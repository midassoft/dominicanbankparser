<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\CSV;
use MidasSoft\DominicanBankParser\Interfaces\ParserInterface;
use MidasSoft\DominicanBankParser\Validators\PopularValidator;

class PopularBankParser extends AbstractParser implements ParserInterface
{
    /**
     * Eliminates unnecesary values into
     * a Popular bank file and convert it
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

        array_walk(array_slice(CSV::sanitize($fileString), 7), function ($line, $key) use (&$fileData) {
            if (!PopularValidator::validate($line)) {
                return;
            }

            $fileData["credit"][] = $line[2]; // amount
            $fileData["date"][] = $line[0]; // date
            $fileData["term"][] = $line[1]; // short description
            $fileData["description"][] = $line[5]; // long description
        });

        $this->failIfIsEmpty($fileData);

        return $fileData;
    }
}
