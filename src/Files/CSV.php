<?php

namespace MidasSoft\DominicanBankParser\Files;

class CSV extends AbstractFile
{
    /**
     * Eliminates all unnecessary
     * values in a CSV file.
     *
     * @return array
     */
    private function sanitize()
    {
        $fileWithoutEmptyLine = preg_replace('/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/', '\n', $this->fileContent);
        $cleanedCsvAmounts = preg_replace('/,(?=[^\"]*\"[^\"]*(?:\"[^\"]*\"[^\"]*)*$)/', '', $fileWithoutEmptyLine);
        $cleanedCsvAmounts = preg_replace('/[\"]+/', '', $cleanedCsvAmounts);

        $lines = explode(PHP_EOL, $cleanedCsvAmounts);

        return $lines;
    }

    /**
     * Converts a CSV string to array.
     *
     * @return array
     */
    public function toArray()
    {
        $csvArray = [];
        foreach ($this->sanitize() as $key => $line) {
            $actualLine = str_getcsv(strip_tags(stripslashes(trim($line))));
            $csvArray[] = array_filter($actualLine);
        }

        return array_values(array_filter($csvArray));
    }
}
