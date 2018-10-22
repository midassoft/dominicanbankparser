<?php

namespace MidasSoft\DominicanBankParser\Cache;

use MidasSoft\DominicanBankParser\Interfaces\CacheInterface;

abstract class AbstractCacheDriver implements CacheInterface
{
    /**
     * The config of the driver.
     *
     * @var array
     */
    protected $config;

    /**
     * The keys of the cached values.
     *
     * @var array
     */
    protected $keys;

    /**
     * Returns the config property.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Returns the value for some config entry.
     *
     * @param string $key
     *
     * @return mixed|null
     */
    public function getConfigKey($key)
    {
        return isset($this->config[$key]) ? $this->config[$key] : null;
    }

    /**
     * Returns the keys property.
     *
     * @return array
     */
    public function getKeys()
    {
        return $this->keys;
    }
}
