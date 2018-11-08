<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposits\PopularDeposit;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Validators\PopularValidator;

class PopularBankParser extends AbstractParser
{
    /**
     * Eliminates unnecessary values into
     * a Popular bank file and convert it
     * to array.
     *
     * @param \MidasSoft\DominicanBankParser\Files\AbstractFile $file
     *
     * @throws \MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException
     * @throws \MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     *
     * @return \MidasSoft\DominicanBankParser\Collections\DepositCollection
     */
    public function parse(AbstractFile $file)
    {
        $collection = new DepositCollection();
        $fileArray = array_slice($file->toArray(), 5);

        array_walk($fileArray, function ($line) use (&$collection) {
            if (!PopularValidator::validate($line)) {
                return;
            }

            $amount = $line[2];
            $date = $line[0];
            $description = $line[5];
            $reference = $line[3];
            $term = $line[1];

            $collection->push(new PopularDeposit($amount, $date, $description, $term, $reference));
        });

        $this->failIfParsedFileIsEmpty($collection);
        $this->cache($collection);

        return $collection;
    }
}
