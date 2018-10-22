<?php

namespace MidasSoft\DominicanBankParser\Validators;

use MidasSoft\DominicanBankParser\Interfaces\ValidatorInterface;

class BHDValidator implements ValidatorInterface
{
    /**
     * {@inheritdoc}
     */
    public static function validate(array $deposit)
    {
        if (!self::dateIsSet($deposit[0]) || !self::referenceIsSet($deposit[4]) || !self::amountIsSet($deposit[6])) {
            return false;
        }

        if (self::amountIsZero($deposit[6])) {
            return false;
        }

        if (self::isWithdraw($deposit[4]) || self::isAnnulment($deposit[4])) {
            return false;
        }

        return true;
    }

    /**
     * Checks if the amount is equal to zero.
     *
     * @param int $amount
     *
     * @return bool
     */
    private static function amountIsZero($amount)
    {
        return $amount == 0;
    }

    /**
     * Checks if date is set.
     *
     * @param string $date
     *
     * @return bool
     */
    private static function dateIsSet($date)
    {
        return isset($date);
    }

    /**
     * Checks if reference is set.
     *
     * @param string $reference
     *
     * @return bool
     */
    private static function referenceIsSet($reference)
    {
        return isset($reference);
    }

    /**
     * Checks if amount is set.
     *
     * @param string $amount
     *
     * @return bool
     */
    private static function amountIsSet($amount)
    {
        return isset($amount);
    }

    /**
     * Checks if the deposit is a withdraw.
     *
     * @param string $description
     *
     * @return bool
     */
    private static function isWithdraw($description)
    {
        strpos(utf8_decode($description), 'Retiro Ahorros CA') != 0;
    }

    /**
     * Checks if amount is set.
     *
     * @param string $description
     *
     * @return bool
     */
    private static function isAnnulment($description)
    {
        strpos(utf8_decode($description), 'Anul.Deposito') != 0;
    }
}
