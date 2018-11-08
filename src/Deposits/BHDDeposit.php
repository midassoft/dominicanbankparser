<?php

namespace MidasSoft\DominicanBankParser\Deposits;

class BHDDeposit extends AbstractDeposit
{
    /**
     * {@inheritdoc}
     */
    const BANK_NAME = 'BHD';

    /**
     * The hour of the deposit.
     *
     * @var string
     */
    private $hour;

    /**
     * Creates a new BHDDeposit object.
     *
     * @param float  $amount
     * @param string $date
     * @param string $description
     * @param string $term
     * @param string $hour
     */
    public function __construct($amount, $date, $description, $term, $hour)
    {
        $this->hour = $hour;

        parent::__construct($amount, $date, $description, $term);
    }

    /**
     * {@inheritdoc}
     */
    public function generateId()
    {
        return md5(
            sprintf('%s-%s-%s-%s-%s', $this::BANK_NAME, $this->amount, $this->date, $this->term, $this->hour)
        );
    }
}
