<?php

namespace MidasSoft\DominicanBankParser\Deposits;

abstract class AbstractDeposit
{
    /**
     * The amount of the deposit.
     *
     * @var float
     */
    protected $amount;

    /**
     * The date of the deposit.
     *
     * @var string
     */
    protected $date;

    /**
     * The description of the deposit.
     *
     * @var string
     */
    protected $description;

    /**
     * The identifier of the deposit.
     *
     * @var string
     */
    protected $id;

    /**
     * The term of the deposit.
     *
     * @var string
     */
    protected $term;

    /**
     * The name of the bank which
     * this deposit come from.
     *
     * @var string
     */
    const BANK_NAME = null;

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
        $this->id = $this->generateId();
        $this->term = $term;
    }

    /**
     * Generates an identifier for the deposit.
     *
     * @return string
     */
    abstract public function generateId();

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
     * Returns the id property.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s|%s|%s|%s|%s', $this::BANK_NAME, $this->amount, $this->date, $this->description, $this->term);
    }
}
