<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposit;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Validators\PopularValidator;

class PopularBankParser extends AbstractParser
{
    /**
     * Eliminates unnecesary values into
     * a Popular bank file and convert it
     * to array.
     *
     * @param AbstractFile $file
     *
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

            $collection->push(new Deposit($line[2], $line[0], $line[5], $line[1], $this->uniqueId($line)));
        });

        $this->failIfParsedFileIsEmpty($collection);
        $this->cache($collection);

        return $collection;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function uniqueId(array $data): string
    {
        return md5($data[2].$data[0].$data[5].'-'.$data[3]);
    }
}
