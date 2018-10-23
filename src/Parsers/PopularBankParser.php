<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposit;
use MidasSoft\DominicanBankParser\Files\CSV;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Validators\PopularValidator;

class PopularBankParser extends AbstractParser
{
    /**
     * Eliminates unnecesary values into
     * a Popular bank file and convert it
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
        $collection = new DepositCollection();
        $fileArray = array_slice($file->toArray(), 5);

        array_walk($fileArray, function ($line, $key) use (&$collection) {
            if (!PopularValidator::validate($line)) {
                return;
            }

            $collection->push(new Deposit($line[2], $line[0], $line[5], $line[1]));
        });

        $this->failIfParsedFileIsEmpty($collection);
        $this->cache($collection);

        return $collection;
    }
}
