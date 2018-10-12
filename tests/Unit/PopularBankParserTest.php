<?php

namespace Tests\Unit;

use MidasSoft\DominicanBankParser\Parsers\PopularBankParser;
use MidasSoft\DominicanBankParser\Files\CSV;
use PHPUnit\Framework\TestCase;

class PopularBankParserTest extends TestCase
{
    /** @test */
    public function it_can_parse_popular_bank()
    {
        $popularParser = new PopularBankParser();
        $file = new CSV(file_get_contents(__DIR__ . '/../resources/popular_bank_file.csv'));
        $parsedData = $popularParser->parse($file);

        $this->assertTrue(is_array($parsedData));
        $this->assertCount(105, $parsedData['credit']);
    }

    /**
     * @test
     * @expectedException MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     * @expectedExceptionMessage You're trying to parse an empty file.
     */
    public function popular_bank_parser_throws_an_exception_when_you_try_to_parse_an_empty_file()
    {
        $popularParser = new PopularBankParser();
        $parsedData = $popularParser->parse(new CSV(''));
    }
}
