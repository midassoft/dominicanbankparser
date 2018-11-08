<?php

namespace MidasSoft\DominicanBankParser\Collections;

use MidasSoft\DominicanBankParser\Deposits\AbstractDeposit;
use MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException;
use Tightenco\Collect\Support\Collection;

class DepositCollection extends Collection
{
    /**
     * {@inheritdoc}
     */
    public function __construct($items = [])
    {
        array_walk($items, function ($value) {
            failIfValueDoesNotInheritFromAbstractDeposit($value);
        });

        parent::__construct($items);
    }

    /**
     * {@inheritdoc}
     */
    public function push($value)
    {
        failIfValueDoesNotInheritFromAbstractDeposit($value);
        parent::push($value);
    }

    /**
     * Throws an exception if a value does
     * not inherit from AbstractDeposit class.
     *
     * @param mixed $value
     *
     * @throws \MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException
     *
     * @return void
     */
    private function failIfValueDoesNotInheritFromAbstractDeposit($value)
    {
        if (!is_subclass_of($value, AbstractDeposit::class)) {
            throw new InvalidArgumentException('You should pass only objects that inherit from AbstractDeposit to this collection.');
        }
    }
}
