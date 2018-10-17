<?php

namespace MidasSoft\DominicanBankParser\Interfaces;

interface CacheInterface
{
    /**
     * Adds a new value to the cache.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function add($key, $value);

    /**
     * Recovers a value from the cache.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * Removes a value from the cache.
     *
     * @param string $key
     *
     * @return void
     */
    public function remove($key);
}
