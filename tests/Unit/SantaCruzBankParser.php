<?php

namespace Tests\Unit;

use MidasSoft\DominicanBankParser\Parsers\SantaCruzBankParser;
use PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{
    /** @test */
    public function it_can_parse_santa_cruz_bank()
    {
        $santaCruzParser = new SantaCruzBankParser();
        $file = file_get_contents(__DIR__ . '/../resources/santa_cruz_bank_file.csv');
        $parsedData = $santaCruzParser->parse($file);

        $this->assertTrue(is_array($parsedData));
        $this->assertCount(6, $parsedData['credit']);
    }

    /**
     * @test
     * @expectedException MidasSoft\DominicanBankParser\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage You have to pass a string as data.
     */
    public function santa_cruz_bank_parser_throws_an_exception_when_you_try_to_parse_a_non_string()
    {
        $santaCruzParser = new SantaCruzBankParser();
        $parsedData = $santaCruzParser->parse(new \StdClass());
    }

    /**
     * @test
     * @expectedException MidasSoft\DominicanBankParser\Exceptions\EmptyFileException
     * @expectedExceptionMessage You're trying to parse an empty file.
     */
    public function santa_cruz_bank_parser_throws_an_exception_when_you_try_to_parse_an_empty_file()
    {
        $santaCruzParser = new SantaCruzBankParser();
        $parsedData = $santaCruzParser->parse('');
    }
}