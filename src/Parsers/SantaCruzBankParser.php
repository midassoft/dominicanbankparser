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
     * @param AbstractFile $file
     *
     * @return \MidasSoft\DominicanBankParser\Collections\DepositCollection
     * @throws \MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     */
    public function parse(AbstractFile $file)
    {
        $collection = new DepositCollection();
        $fileArray = array_slice($file->toArray(), 7);

        array_walk($fileArray, function ($line) use (&$collection) {
            if (!SantaCruzValidator::validate($line)) {
                return;
            }

            $collection->push(new Deposit($line[3], $line[0], $line[1], $line[1], $this->uniqueId($line)));
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
        return md5($data[3].$data[0].$data[1].'-'.$data[4]);
    }
}
