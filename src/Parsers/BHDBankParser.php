<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposits\BHDDeposit;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Traits\InteractsWithArrayTrait;
use MidasSoft\DominicanBankParser\Validators\BHDValidator;

class BHDBankParser extends AbstractParser
{
    use InteractsWithArrayTrait;

    /**
     * Eliminates unnecessary values into
     * a BHD bank file and convert it
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
        $fileArray = array_slice($file->toArray(), 3);

        array_walk($fileArray, function ($line) use (&$collection) {
            if (!BHDValidator::validate($line)) {
                return;
            }

            $amount = $line[6];
            $date = $line[0];
            $description = $line[4];
            $hour = $line[9];
            $term = $line[4];

            $collection->push(new BHDDeposit($amount, $date, $description, $term, $hour));
        });

        $this->failIfParsedFileIsEmpty($collection);
        $this->cache($collection);

        return $collection;
    }
}
