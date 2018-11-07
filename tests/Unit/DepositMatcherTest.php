<?php

namespace Tests\Unit;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposit;
use MidasSoft\DominicanBankParser\DepositMatcher;
use PHPUnit\Framework\TestCase;

class DepositMatcherTest extends TestCase
{
    /** @var DepositMatcher depositMatcher */
    private $depositMatcher;

    public function setUp()
    {

        $this->depositMatcher = new DepositMatcher();
        parent::setUp();
    }

    /** @test */
    public function it_returns_the_differences_between_two_deposit_collections()
    {
        $collection1 = new DepositCollection([
            new Deposit(500, '10/22/2018', 'fake deposit 1', 'debito','unique-id-1'),
            new Deposit(400, '10/22/2018', 'fake deposit 2', 'credito','unique-id-1'),
            new Deposit(300, '10/22/2018', 'fake deposit 3', 'debito','unique-id-1'),
        ]);
        $collection2 = new DepositCollection([
            new Deposit(500, '10/22/2018', 'fake deposit 1', 'debito','unique-id-1'),
            new Deposit(450, '10/22/2018', 'fake deposit 2', 'credito','unique-id-1'),
            new Deposit(300, '10/22/2018', 'fake deposit 3', 'debito','unique-id-1'),
        ]);
        $differences = $this->depositMatcher->getDifference($collection1, $collection2);

        $annulments = $this->depositMatcher->getAnnulments($collection1, $collection2);
        $expectedDifference = new DepositCollection([
            new Deposit(400, '10/22/2018', 'fake deposit 2', 'credito','unique-id-1'),
        ]);
        $expectedAnnulments = new DepositCollection([
            new Deposit(450, '10/22/2018', 'fake deposit 2', 'credito','unique-id-1'),
        ]);

        $this->assertCount(1, $differences); // New deposits
        $this->assertEquals(array_values($expectedDifference->toArray()), array_values($differences->toArray()));
        $this->assertCount(1, $annulments); // Annulments
        $this->assertEquals(array_values($expectedAnnulments->toArray()), array_values($annulments->toArray()));
    }

    /** @test */
    public function if_the_line_of_the_deposit_are_identical()
    {
        $collection1 = new DepositCollection([
            new Deposit(500, '10/22/2018', 'fake deposit 1', 'debito','unique-id-1'),
            new Deposit(400, '10/22/2018', 'fake deposit 2', 'credito','unique-id-1'),
            new Deposit(300, '10/22/2018', 'fake deposit 3', 'debito','unique-id-1'),
        ]);
        $collection2 = new DepositCollection([
            new Deposit(500, '10/22/2018', 'fake deposit 1', 'debito','unique-id-1'),
            new Deposit(400, '10/22/2018', 'fake deposit 2', 'credito','unique-id-1'),
            new Deposit(300, '10/22/2018', 'fake deposit 3', 'debito','unique-id-1'),
            // Differences:
            new Deposit(500, '10/22/2018', 'fake deposit 1', 'debito','unique-id-2'),
            new Deposit(340, '10/22/2018', 'fake deposit 5', 'debito','unique-id-3'),
            new Deposit(370, '10/22/2018', 'fake deposit 9', 'debito','unique-id-4'),
        ]);
        $differences = $this->depositMatcher->getDifference($collection2, $collection1);

        $this->assertCount(3, $differences); // New deposits
    }
}
