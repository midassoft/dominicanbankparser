<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposits\ReservasDeposit;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Traits\InteractsWithArrayTrait;
use MidasSoft\DominicanBankParser\Validators\ReservasValidator;

class ReservasBankParser extends AbstractParser
{
    use InteractsWithArrayTrait;

    /**
     * Eliminates unnecessary values into
     * a Reservas bank file and convert it
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
        $fileArray = array_slice($file->toArray(), 1);

        array_walk($fileArray, function ($line) use (&$collection) {
            if (!ReservasValidator::validate($line)) {
                return;
            }

            $amount = trim($line[5]);
            $date = $line[1];
            $description = $line[7];
            $reference = $line[3];
            $term = $line[2];

            $collection->push(new ReservasDeposit($amount, $date, $description, $term, $reference));
        });

        $this->failIfParsedFileIsEmpty($collection);
        $this->cache($collection);

        return $collection;
    }
}
