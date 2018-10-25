<?php

namespace MidasSoft\DominicanBankParser\Traits;

trait InteractsWithArrayTrait
{
    /**
     * Reverse every value whitin the array.
     *
     * @param array $array
     *
     * @return array
     */
    private function reverseMultidimensionalArrayValues(array $array)
    {
        return array_map(function ($value) {
            return array_reverse($value);
        }, $array);
    }
}
