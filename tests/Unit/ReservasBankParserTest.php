<?php

namespace Tests\Unit;

use MidasSoft\DominicanBankParser\Parsers\ReservasBankParser;
use MidasSoft\DominicanBankParser\Files\CSV;
use PHPUnit\Framework\TestCase;

class ReservasBankParserTest extends TestCase
{
    /** @test */
    public function it_can_parse_reservas_bank()
    {
        $reservasParser = new ReservasBankParser();
        $file = new CSV(file_get_contents(__DIR__ . '/../resources/reservas_bank_file.csv'));
        $parsedData = $reservasParser->parse($file);

        $this->assertInstanceOf('Illuminate\Support\Collection', $parsedData);
        $this->assertCount(26, $parsedData);
    }

    /**
     * @test
     * @expectedException MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     * @expectedExceptionMessage You're trying to parse an empty file.
     */
    public function reservas_bank_parser_throws_an_exception_when_you_try_to_parse_an_empty_file()
    {
        $reservasParser = new ReservasBankParser();
        $parsedData = $reservasParser->parse(new CSV(''));
    }
}
