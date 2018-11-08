<?php

namespace MidasSoft\DominicanBankParser\Deposits;

class ReservasDeposit extends AbstractDeposit
{
    /**
     * {@inheritdoc}
     */
    const BANK_NAME = 'Reservas';

    /**
     * The reference of the deposit.
     *
     * @var string
     */
    private $reference;

    /**
     * Creates a new SantaCruzDeposit object.
     *
     * @param float  $amount
     * @param string $date
     * @param string $description
     * @param string $term
     * @param string $reference
     */
    public function __construct($amount, $date, $description, $term, $reference)
    {
        $this->reference = $reference;

        parent::__construct($amount, $date, $description, $term);
    }

    /**
     * {@inheritdoc}
     */
    public function generateId()
    {
        return md5(
            sprintf('%s-%s-%s-%s-%s', $this::BANK_NAME, $this->amount, $this->date, $this->term, $this->reference)
        );
    }
}
