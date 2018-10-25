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
        'path'     => '',
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
     * {@inheritdoc}
     */
    public function add($key, $value)
    {
        $filename = sprintf('%s/%s.txt', $this->config['path'], $key);
        $this->keys[] = $key;

        file_put_contents($filename, serialize($value));
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        $filename = sprintf('%s/%s.txt', $this->config['path'], $key);

        return unserialize(file_get_contents($filename));
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        unlink(sprintf('%s/%s.txt', $this->config['path'], $key));
    }
}
