<?php

namespace MidasSoft\DominicanBankParser\Cache;

use MidasSoft\DominicanBankParser\Interfaces\CacheInterface;

class ArrayCacheDriver implements CacheInterface
{
    /**
     * The data container.
     *
     * @var array
     */
    private $data;

    /**
     * Adds a new value to the cache.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function add($key, $value)
    {
        $this->data[$key] = serialize($value);
    }

    /**
     * Recovers a value from the cache.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return unserialize($this->data[$key]);
    }

    /**
     * Returns the data property.
     *
     * @var array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Removes a value from the cache.
     *
     * @param string $key
     *
     * @return void
     */
    public function remove($key)
    {
        unset($this->data[$key]);
    }
}
