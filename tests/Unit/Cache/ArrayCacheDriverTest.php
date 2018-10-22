<?php

namespace Tests\Unit\Cache;

use MidasSoft\DominicanBankParser\Cache\ArrayCacheDriver;
use PHPUnit\Framework\TestCase;

class ArrayCacheDriverTest extends TestCase
{
    private $cacheDriver;

    protected function setUp()
    {
        $this->cacheDriver = new ArrayCacheDriver();

        parent::setUp();
    }

    /** @test */
    public function it_can_add_and_element()
    {
        $this->cacheDriver->add('key1', 'value 1');
        $this->assertCount(1, $this->cacheDriver->getData());
        $this->assertArrayHasKey('key1', $this->cacheDriver->getData());
    }

    /** @test */
    public function it_can_remove_and_element()
    {
        $this->cacheDriver->add('key1', 'value 1');
        $this->cacheDriver->remove('key1');
        $this->assertCount(0, $this->cacheDriver->getData());
        $this->assertArrayNotHasKey('key1', $this->cacheDriver->getData());
    }

    /** @test */
    public function it_can_retrieve_and_element()
    {
        $this->cacheDriver->add('key1', 'value 1');
        $this->assertEquals('value 1', $this->cacheDriver->get('key1'));
    }
}
