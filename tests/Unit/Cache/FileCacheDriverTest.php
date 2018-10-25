<?php

namespace Tests\Unit\Cache;

use MidasSoft\DominicanBankParser\Cache\FileCacheDriver;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;
use PHPUnit\Framework\TestCase;

class FileCacheDriverTest extends TestCase
{
    private $cacheDriver;

    protected function setUp()
    {
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('cache'));

        $this->cacheDriver = new FileCacheDriver([
            'path'     => vfsStreamWrapper::getRoot()->url(),
            'timezone' => 'America/Santo_Domingo',
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

    /** @test */
    public function it_can_list_all_cached_elements()
    {
        $this->cacheDriver->add('file1', 'content 1');
        $this->cacheDriver->add('file2', 'content 2');

        $cachedFiles = $this->cacheDriver->getKeys();

        $this->assertCount(2, $cachedFiles);
        $this->assertEquals('file1', $cachedFiles[0]);
        $this->assertEquals('file2', $cachedFiles[1]);
    }
}
