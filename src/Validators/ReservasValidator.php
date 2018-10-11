<?php

namespace MidasSoft\DominicanBankParser\Validators;

use MidasSoft\DominicanBankParser\Interfaces\ValidatorInterface;

class ReservasValidator implements ValidatorInterface
{
    /**
     * {@inheritdoc}
     */
    public static function validate(array $deposit)
    {
        if (self::amountIsZero(trim($deposit[5]))) {
            return false;
        }

        if (self::amountIsWithdrawWithoutNotebook($deposit[2])) {
            return false;
        }

        return true;
    }

    /**
     * Checks if amount is zero.
     *
     * @param string $amount
     *
     * @return bool
     */
    private static function amountIsZero($amount)
    {
        return $amount == 0;
    }

    /**
     * Checks if the deposit is a withdraw.
     *
     * @param string $description
     *
     * @return bool
     */
    private static function amountIsWithdrawWithoutNotebook($description)
    {
        return $description == 'Retiro de ahorros sin libreta';
    }
}
