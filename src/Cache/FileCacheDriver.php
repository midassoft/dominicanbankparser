<?php

namespace MidasSoft\DominicanBankParser\Cache;

class FileCacheDriver extends AbstractCacheDriver
{
    /**
     * The config of the driver.
     *
     * @var array
     */
    protected $config = [
        'path' => '',
        'timezone' => 'America/Santo_Domingo',
    ];

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
        $this->keys[] = $key;
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
