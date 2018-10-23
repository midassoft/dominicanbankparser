<?php

namespace Tests\Unit;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposit;
use MidasSoft\DominicanBankParser\DepositMatcher;
use PHPUnit\Framework\TestCase;

class DepositMatcherTest extends TestCase
{
    private $DepositMatcher;

    public function setUp()
    {
        $this->depositMatcher = new DepositMatcher();
        parent::setUp();
    }

    /** @test */
    public function it_returns_the_differences_between_two_deposit_collections()
    {
        $collection1 = new DepositCollection([
            new Deposit(500, '10/22/2018', 'fake deposit 1', 'debito'),
            new Deposit(400, '10/22/2018', 'fake deposit 2', 'credito'),
            new Deposit(300, '10/22/2018', 'fake deposit 3', 'debito'),
        ]);
        $collection2 = new DepositCollection([
            new Deposit(500, '10/22/2018', 'fake deposit 1', 'debito'),
            new Deposit(450, '10/22/2018', 'fake deposit 2', 'credito'),
            new Deposit(300, '10/22/2018', 'fake deposit 3', 'debito'),
        ]);
        $differences = $this->depositMatcher->getDifference($collection1, $collection2);
        $annulments = $this->depositMatcher->getAnnulments($collection1, $collection2);
        $expectedDifference = new DepositCollection([
            new Deposit(400, '10/22/2018', 'fake deposit 2', 'credito')
        ]);
        $expectedAnnulments = new DepositCollection([
            new Deposit(450, '10/22/2018', 'fake deposit 2', 'credito')
        ]);

        $this->assertCount(1, $differences); // New deposits
        $this->assertEquals(array_values($expectedDifference->toArray()), array_values($differences->toArray()));
        $this->assertCount(1, $annulments); // Annulments
        $this->assertEquals(array_values($expectedAnnulments->toArray()), array_values($annulments->toArray()));
    }
}
