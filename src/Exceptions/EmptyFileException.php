<?php

namespace MidasSoft\DominicanBankParser\Exceptions;

use Exception;

class EmptyFileException extends Exception
{
    /**
     * Returns the string representation
     * of the Exception.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s: [%d]: %s', __CLASS__, $this->code, $this->message);
    }
}
