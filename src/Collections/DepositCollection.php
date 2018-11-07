<?php

namespace MidasSoft\DominicanBankParser\Collections;

use MidasSoft\DominicanBankParser\Deposit;
use MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException;
use MidasSoft\DominicanBankParser\Exceptions\InvalidUniqueIdException;
use Tightenco\Collect\Support\Collection;

class DepositCollection extends Collection
{
    /**
     * {@inheritdoc}
     */
    public function __construct($items = [])
    {
        array_walk($items, function ($value) {
            if (!$value instanceof Deposit) {
                throw new InvalidArgumentException('You should pass only Deposit objects to this collection.');
            }

            if (! $value->getUniqueId()) {
                throw new InvalidUniqueIdException("Invalid uniqueId.");
            }
        });

        parent::__construct($items);
    }

    /**
     * {@inheritdoc}
     */
    public function push($value)
    {
        if (!$value instanceof Deposit) {
            throw new InvalidArgumentException('You should pass only Deposit objects to this collection.');
        }

        parent::push($value);
    }
}
