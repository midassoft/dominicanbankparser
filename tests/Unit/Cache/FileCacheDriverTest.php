<?php

namespace Tests\Unit\Cache;

use MidasSoft\DominicanBankParser\Cache\FileCacheDriver;
use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamDirectory;

class FileCacheDriverTest extends TestCase
{
    private $cacheDriver;

    protected function setUp()
    {
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('cache'));

        $this->cacheDriver = new FileCacheDriver([
            'path' => vfsStreamWrapper::getRoot()->url(),
        ]);

        parent::setUp();
    }

    /** @test */
    public function it_can_add_and_element()
    {
        $this->cacheDriver->add('file1', 'content 1');
        $this->assertTrue(vfsStreamWrapper::getRoot()->hasChild('file1.txt'));
    }

    /** @test */
    public function it_can_remove_and_element()
    {
        $this->cacheDriver->add('file1', 'content 1');
        $this->cacheDriver->remove('file1');
        $this->assertFalse(vfsStreamWrapper::getRoot()->hasChild('file1.txt'));
    }

    /** @test */
    public function it_can_retrieve_and_element()
    {
        $this->cacheDriver->add('file1', 'content 1');
        $this->assertEquals('content 1', $this->cacheDriver->get('file1'));
    }
}
