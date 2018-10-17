<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use Illuminate\Support\Collection;
use MidasSoft\DominicanBankParser\Deposit;
use MidasSoft\DominicanBankParser\Files\CSV;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Interfaces\ParserInterface;
use MidasSoft\DominicanBankParser\Traits\InteractsWithArrayTrait;
use MidasSoft\DominicanBankParser\Validators\BHDValidator;

class BHDBankParser extends AbstractParser implements ParserInterface
{
    use InteractsWithArrayTrait;

    /**
     * Eliminates unnecesary values into
     * a BHD bank file and convert it
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
        $collection = new Collection();

        array_walk(array_slice($file->toArray(), 3), function ($line, $key) use (&$collection) {
            if (!BHDValidator::validate($line)) {
                return;
            }

            $collection->push(new Deposit($line[6], $line[0], $line[4], $line[4]));
        });

        $this->failIfParsedFileIsEmpty($collection);

        if (!is_null($this->cacheManager)) {
            $this->cacheManager->add(date('Ymd'), $collection);
        }

        return $collection;
    }
}
