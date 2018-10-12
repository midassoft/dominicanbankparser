<?php

namespace Tests\Unit;

use MidasSoft\DominicanBankParser\Files\CSV;
use PHPUnit\Framework\TestCase;

class CSVTest extends TestCase
{
    /**
     * @test
     * @expectedException MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage You have to pass a string as the file content.
     */
    public function it_throws_an_exception_when_you_pass_a_non_string_value_to_the_constructor()
    {
        new CSV(new \StdClass());
    }
}
