<?php

namespace MidasSoft\DominicanBankParser;

class CSV
{
    /**
     * Eliminates all unnecesary
     * values in a CSV file.
     *
     * @param string $csvString
     *
     * @return array
     */
    public static function sanitize($csvString)
    {
        $fileWithoutEmptyLine = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $csvString);
        $cleanedCsvAmounts = preg_replace("/,(?=[^\"]*\"[^\"]*(?:\"[^\"]*\"[^\"]*)*$)/", '', $fileWithoutEmptyLine);
        $cleanedCsvAmounts = preg_replace("/[\"]+/", '', $cleanedCsvAmounts);

        $lines = explode(PHP_EOL, $cleanedCsvAmounts);

        return self::toArray($lines);
    }

    /**
     * Converts a CSV string to array.
     *
     * @param string $csvString
     *
     * @return array
     */
    public static function toArray(array $lines)
    {
        $csvArray = [];
        foreach ($lines as $key => $line) {
            $actualLine = str_getcsv(strip_tags(stripslashes(trim($line))));
            $csvArray[] = array_filter($actualLine);
        }

        return array_values(array_filter($csvArray));
    }
}
