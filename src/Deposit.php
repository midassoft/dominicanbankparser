<?php

namespace MidasSoft\DominicanBankParser;

class Deposit
{
    /**
     * The amount of the deposit.
     *
     * @var float
     */
    private $amount;

    /**
     * The date of the deposit.
     *
     * @var string
     */
    private $date;

    /**
     * The description of the deposit.
     *
     * @var string
     */
    private $description;

    /**
     * The term of the deposit.
     *
     * @var string
     */
    private $term;

    /**
     * Creates a new Deposit object.
     *
     * @param float  $amount
     * @param string $date
     * @param string $description
     * @param string $term
     */
    public function __construct($amount, $date, $description, $term)
    {
        $this->amount = $amount;
        $this->date = $date;
        $this->description = $description;
        $this->term = $term;
    }

    /**
     * Returns the amount property.
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Returns the date property.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns the description property.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the term property.
     *
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }
}
