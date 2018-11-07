<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposit;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Traits\InteractsWithArrayTrait;
use MidasSoft\DominicanBankParser\Validators\ReservasValidator;

class ReservasBankParser extends AbstractParser
{
    use InteractsWithArrayTrait;

    /**
     * Eliminates unnecesary values into
     * a Reservas bank file and convert it
     * to array.
     *
     * @param AbstractFile $file
     *
     * @return \MidasSoft\DominicanBankParser\Collections\DepositCollection
     * @throws \MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     */
    public function parse(AbstractFile $file)
    {
        $collection = new DepositCollection();
        $fileArray = array_slice($file->toArray(), 1);

        array_walk($fileArray, function ($line) use (&$collection) {
            if (!ReservasValidator::validate($line)) {
                return;
            }

            $collection->push(new Deposit(trim($line[5]), $line[1], $line[7], $line[2], $this->uniqueId($line)));
        });

        $this->failIfParsedFileIsEmpty($collection);
        $this->cache($collection);

        return $collection;
    }

    /**
     * @param array $data
     * @return string
     */
    public function uniqueId(array $data): string
    {
        return md5($data[5].$data[1].$data[7].'-'.$data[3]);
    }
}
