<?php

namespace MidasSoft\DominicanBankParser\Cache;

use MidasSoft\DominicanBankParser\Interfaces\CacheInterface;

class FileCacheDriver implements CacheInterface
{
    /**
     * The config of the driver.
     *
     * @var array
     */
    private $config;

    /**
     * Creates a new FileCacheDriver instance.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritDoc}
     */
    public function add($key, $value)
    {
        $filename = sprintf('%s/%s.txt', $this->config['path'], $key);
        $file = fopen($filename, 'w');

        fwrite($file, serialize($value));
        fclose($file);
    }

    /**
     * {@inheritDoc}
     */
    public function get($key)
    {
        $filename = sprintf('%s/%s.txt', $this->config['path'], $key);
        $file = fopen($filename, 'r');
        $content = fread($file, filesize($filename));

        return unserialize($content);
    }

    /**
     * {@inheritDoc}
     */
    public function remove($key)
    {
        unlink(sprintf('%s/%s.txt', $this->config['path'], $key));
    }
}
