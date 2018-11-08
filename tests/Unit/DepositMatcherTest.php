<?php

namespace Tests\Unit;

use MidasSoft\DominicanBankParser\Collections\DepositCollection;
use MidasSoft\DominicanBankParser\Deposits\BHDDeposit;
use MidasSoft\DominicanBankParser\Deposits\DepositMatcher;
use PHPUnit\Framework\TestCase;

class DepositMatcherTest extends TestCase
{
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
            new BHDDeposit(500, '10/22/2018', 'fake deposit 1', 'debito', '10:15'),
            new BHDDeposit(400, '10/22/2018', 'fake deposit 2', 'credito', '11:23'),
            new BHDDeposit(300, '10/22/2018', 'fake deposit 3', 'debito', '15:22'),
        ]);
        $collection2 = new DepositCollection([
            new BHDDeposit(500, '10/22/2018', 'fake deposit 1', 'debito', '10:15'),
            new BHDDeposit(450, '10/22/2018', 'fake deposit 2', 'credito', '11:23'),
            new BHDDeposit(300, '10/22/2018', 'fake deposit 3', 'debito', '15:22'),
        ]);
        $differences = $this->depositMatcher->getDifference($collection1, $collection2);
        $annulments = $this->depositMatcher->getAnnulments($collection1, $collection2);
        $expectedDifference = new DepositCollection([
            new BHDDeposit(400, '10/22/2018', 'fake deposit 2', 'credito', '11:23'),
        ]);
        $expectedAnnulments = new DepositCollection([
            new BHDDeposit(450, '10/22/2018', 'fake deposit 2', 'credito', '11:23'),
        ]);

        $this->assertCount(1, $differences); // New deposits
        $this->assertEquals(array_values($expectedDifference->toArray()), array_values($differences->toArray()));
        $this->assertCount(1, $annulments); // Annulments
        $this->assertEquals(array_values($expectedAnnulments->toArray()), array_values($annulments->toArray()));
    }
}
