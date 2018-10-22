<?php

namespace MidasSoft\DominicanBankParser\Validators;

use MidasSoft\DominicanBankParser\Interfaces\ValidatorInterface;

class SantaCruzValidator implements ValidatorInterface
{
    /**
     * {@inheritdoc}
     */
    public static function validate(array $deposit)
    {
        if (count($deposit) != 4) {
            return false;
        }

        if (self::isRetirement($deposit[1])) {
            return false;
        }

        return true;
    }

    /**
     * Checks if the deposit is a retirement.
     *
     * @param string $description
     *
     * @return bool
     */
    private static function isRetirement($description)
    {
        return $description == 'Retiro Por Cajas';
    }
}
