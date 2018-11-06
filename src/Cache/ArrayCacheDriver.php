<?php

namespace MidasSoft\DominicanBankParser\Cache;

class ArrayCacheDriver extends AbstractCacheDriver
{
    /**
     * The data container.
     *
     * @var array
     */
    protected $data;

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
        $this->keys[] = $key;
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
     * @return array
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
