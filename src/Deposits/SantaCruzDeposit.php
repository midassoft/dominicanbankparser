<?php

namespace MidasSoft\DominicanBankParser\Deposits;

class SantaCruzDeposit extends AbstractDeposit
{
    /**
     * {@inheritdoc}
     */
    const BANK_NAME = 'Santa Cruz';

    /**
     * The remaining balance in the
     * bank account after the deposit.
     *
     * @var float
     */
    private $remainingBalance;

    /**
     * Creates a new SantaCruzDeposit object.
     *
     * @param float  $amount
     * @param string $date
     * @param string $description
     * @param string $term
     * @param float  $remainingBalance
     */
    public function __construct($amount, $date, $description, $term, $remainingBalance)
    {
        $this->remainingBalance = $remainingBalance;

        parent::__construct($amount, $date, $description, $term);
    }

    /**
     * {@inheritdoc}
     */
    public function generateId()
    {
        return md5(
            sprintf('%s-%s-%s-%s-%s', $this::BANK_NAME, $this->amount, $this->date, $this->term, $this->remainingBalance)
        );
    }
}
