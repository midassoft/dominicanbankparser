<?php

namespace MidasSoft\DominicanBankParser\Parsers;

use Illuminate\Support\Collection;
use MidasSoft\DominicanBankParser\Deposit;
use MidasSoft\DominicanBankParser\Files\CSV;
use MidasSoft\DominicanBankParser\Files\AbstractFile;
use MidasSoft\DominicanBankParser\Interfaces\ParserInterface;
use MidasSoft\DominicanBankParser\Traits\InteractsWithArrayTrait;
use MidasSoft\DominicanBankParser\Validators\ReservasValidator;

class ReservasBankParser extends AbstractParser implements ParserInterface
{
    use InteractsWithArrayTrait;

    /**
     * Eliminates unnecesary values into
     * a Reservas bank file and convert it
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

        array_walk(array_slice($file->toArray(), 1), function ($line, $key) use (&$collection) {
            if (!ReservasValidator::validate($line)) {
                return;
            }

            $collection->push(new Deposit(trim($line[5]), $line[1], $line[7], $line[2]));
        });

        $this->failIfParsedFileIsEmpty($collection);

        return $collection;
    }
}
