<?php

namespace MidasSoft\DominicanBankParser\Interfaces;

use MidasSoft\DominicanBankParser\Files\AbstractFile;

interface ParserInterface
{
    public function parse(AbstractFile $fileData);

    public function uniqueId(array $data):string;
}
