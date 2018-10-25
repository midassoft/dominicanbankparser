<?php

namespace MidasSoft\DominicanBankParser\Validators;

use MidasSoft\DominicanBankParser\Interfaces\ValidatorInterface;

class PopularValidator implements ValidatorInterface
{
    /**
     * {@inheritdoc}
     */
    public static function validate(array $deposit)
    {
        $deposit = array_map(function ($value) {
            return utf8_decode($value);
        }, $deposit);

        if (!self::shortDescriptionIsSet($deposit[1]) && !self::amountIsSet($deposit[2]) && !self::longDescriptionIsSet($deposit[5])) {
            return false;
        }

        if (!self::isValidDate($deposit[0])) {
            return false;
        }

        if (self::isHeader($deposit[2])) {
            return false;
        }

        if (self::isCommision($deposit[1])) {
            return false;
        }

        if (self::isTax($deposit[5])) {
            return false;
        }

        return true;
    }

    /**
     * Checks if the deposit is a tax payment.
     *
     * @param string $longDescription
     *
     * @return bool
     */
    private static function isTax($longDescription)
    {
        return substr(utf8_decode($longDescription), 0, 13) == 'PAGO IMPUESTO';
    }

    /**
     * Checks if the deposit is a commision payment.
     *
     * @param string $shortDescription
     *
     * @return bool
     */
    private static function isCommision($shortDescription)
    {
        return in_array(utf8_decode($shortDescription), ['DB Comisiones', 'D?bito Cuenta']);
    }

    /**
     * Checks if the current line is a header.
     *
     * @param string $amount
     *
     * @return bool
     */
    private static function isHeader($amount)
    {
        return substr($amount, 0, 5) == 'Monto Transac';
    }

    /**
     * Checks if the date is valid.
     *
     * @param string $date
     *
     * @return bool
     */
    private static function isValidDate($date)
    {
        return boolval(preg_match('/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/', $date));
    }

    /**
     * Checks if the short description is set.
     *
     * @param string $description
     *
     * @return bool
     */
    private static function shortDescriptionIsSet($description)
    {
        return isset($description);
    }

    /**
     * Checks if the amount is set.
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
     * Checks if the amount is set.
     *
     * @param string $description
     *
     * @return bool
     */
    private static function longDescriptionIsSet($description)
    {
        return isset($description);
    }
}
