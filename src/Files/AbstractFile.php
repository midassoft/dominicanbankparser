<?php

namespace MidasSoft\DominicanBankParser\Files;

use MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException;

abstract class AbstractFile
{
    /**
     * The content of the file.
     *
     * @var string
     */
    protected $fileContent;

    /**
     * Creates a new file.
     *
     * @param string $fileContent
     *
     * @throws \MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException
     */
    public function __construct($fileContent)
    {
        if (!is_string($fileContent)) {
            throw new InvalidArgumentException('You have to pass a string as the file content.');
        }

        $this->fileContent = $fileContent;
    }

    /**
     * Returns the array representation
     * of the file.
     *
     * @return array
     */
    public abstract function toArray();
}
