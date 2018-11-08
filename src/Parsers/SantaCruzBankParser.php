<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposits\SantaCruzDeposit;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Validators\SantaCruzValidator;

class SantaCruzBankParser extends AbstractParser
{
    /**
     * Eliminates unnecessary values into
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

            $amount = $line[3];
            $remainingBalance = $line[4];
            $date = $line[0];
            $description = $line[1];
            $term = $line[1];

            $collection->push(new SantaCruzDeposit($amount, $date, $description, $term, $remainingBalance));
        });

        $this->failIfParsedFileIsEmpty($collection);
        $this->cache($collection);

        return $collection;
    }
}
