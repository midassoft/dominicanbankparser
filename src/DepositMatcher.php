<?php

namespace MidasSoft\DominicanBankParser;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;

class DepositMatcher
{
    /**
     * Returns the difference between two
     * DepositCollection objects.
     *
     * @param \MidasSoft\DominicanBankParser\Collections\DepositCollection $collection1
     * @param \MidasSoft\DominicanBankParser\Collections\DepositCollection $collection2
     *
     * @return \MidasSoft\DominicanBankParser\Collections\DepositCollection
     */
    public function getDifference(DepositCollection $collection1, DepositCollection $collection2)
    {
        return $collection1->diff($collection2);
    }

    /**
     * Returns the difference between two
     * DepositCollection objects.
     *
     * @param \MidasSoft\DominicanBankParser\Collections\DepositCollection $collection1
     * @param \MidasSoft\DominicanBankParser\Collections\DepositCollection $collection2
     *
     * @return \MidasSoft\DominicanBankParser\Collections\DepositCollection
     */
    public function getAnnulments(DepositCollection $collection1, DepositCollection $collection2)
    {
        return $collection2->diff($collection1);
    }
}
