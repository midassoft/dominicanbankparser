<?php

namespace MidasSoft\DominicanBankParser\Interfaces;

interface ValidatorInterface
{
    /**
     * Performs custom validation over one deposit.
     *
     * @param array $deposit
     *
     * @return bool
     */
    public static function validate(array $deposit);
}
