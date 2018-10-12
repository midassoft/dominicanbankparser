<?php

namespace Tests\Unit;

use MidasSoft\DominicanBankParser\Parsers\BHDBankParser;
use MidasSoft\DominicanBankParser\Files\CSV;
use PHPUnit\Framework\TestCase;

class BHDBankParserTest extends TestCase
{
    /** @test */
    public function it_can_parse_bhd_bank()
    {
        $bhdParser = new BHDBankParser();
        $file = new CSV(file_get_contents(__DIR__ . '/../resources/bhd_bank_file.csv'));
        $parsedData = $bhdParser->parse($file);

        $this->assertTrue(is_array($parsedData));
        $this->assertCount(91, $parsedData['credit']);
    }

    /**
     * @test
     * @expectedException MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     * @expectedExceptionMessage You're trying to parse an empty file.
     */
    public function bhd_bank_parser_throws_an_exception_when_you_try_to_parse_an_empty_file()
    {
        $bhdParser = new BHDBankParser();
        $parsedData = $bhdParser->parse(new CSV(''));
    }
}
