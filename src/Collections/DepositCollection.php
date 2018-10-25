<?php

namespace MidasSoft\DominicanBankParser\Collections;

use MidasSoft\DominicanBankParser\Deposit;
use MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException;
use Tightenco\Collect\Support\Collection;

class DepositCollection extends Collection
{
    /**
     * {@inheritdoc}
     */
    public function __construct($items = [])
    {
        array_walk($items, function ($value, $key) {
            if (!$value instanceof Deposit) {
                throw new InvalidArgumentException('You should pass only Deposit objects to this collection.');
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
