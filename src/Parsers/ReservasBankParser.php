<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Files\CSV;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Interfaces\ParserInterface;
use MidasSoft\DominicanBankParser\Traits\InteractsWithArrayTrait;
use MidasSoft\DominicanBankParser\Validators\ReservasValidator;

class ReservasBankParser extends AbstractParser implements ParserInterface
{
    use InteractsWithArrayTrait;

    /**
     * Eliminates unnecesary values into
     * a Reservas bank file and convert it
     * to array.
     *
     * @param \MidasSoft\DominicanBankParser\Files\CSV $file
     *
     * @throws \MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException
     * @throws \MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     *
     * @return array
     */
    public function parse(AbstractFile $file)
    {
        $fileData = [];

        array_walk(array_slice($file->toArray(), 1), function ($line, $key) use (&$fileData) {
            if (!ReservasValidator::validate($line)) {
                return;
            }

            $fileData['credit'][] = trim($line[5]); // amount
            $fileData['date'][] = $line[1]; // date
            $fileData['term'][] = $line[2]; // short description
            $fileData['description'][] = $line[7]; // long description
        });

        $this->failIfParsedFileIsEmpty($fileData);

        return $this->reverseMultidimensionalArrayValues($fileData);
    }
}
