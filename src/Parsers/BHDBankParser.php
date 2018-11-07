<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposit;
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
     * @param AbstractFile $file
     *
     * @return \MidasSoft\DominicanBankParser\Collections\DepositCollection
     * @throws \MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     */
    public function parse(AbstractFile $file)
    {
        $collection = new DepositCollection();
        $fileArray = array_slice($file->toArray(), 3);

        array_walk($fileArray, function ($line) use (&$collection) {
            if (!BHDValidator::validate($line)) {
                return;
            }

            $collection->push(new Deposit($line[6], $line[0], $line[4], $line[4], $this->uniqueId($line)));
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
        return md5($data[6].$data[0].$data[4].'-'.$data[9]);
    }
}
