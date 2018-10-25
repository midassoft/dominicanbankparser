<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposit;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Validators\SantaCruzValidator;

class SantaCruzBankParser extends AbstractParser
{
    /**
     * Eliminates unnecesary values into
     * a Santa Cruz bank file and convert it
     * to array.
     *
     * @param \MidasSoft\DominicanBankParser\Files\CSV $file
     *
     * @throws \MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException
     * @throws \MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     *
     * @return \MidasSoft\DominicanBankParser\Collections\DepositCollection
     */
    public function parse(AbstractFile $file)
    {
        $collection = new DepositCollection();
        $fileArray = array_slice($file->toArray(), 7);

        array_walk($fileArray, function ($line) use (&$collection) {
            if (!SantaCruzValidator::validate($line)) {
                return;
            }

            $collection->push(new Deposit($line[3], $line[0], $line[1], $line[1]));
        });

        $this->failIfParsedFileIsEmpty($collection);
        $this->cache($collection);

        return $collection;
    }
}
