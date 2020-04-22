<?php

namespace Csv2Json;

use Csv2Json\Exception\FileCannotBeOpenedException;

final class CsvReader
{
    private const ALLOWED_DELIMITERS = [',', ';', '|', ' '];
    private const ENCLOSURE = '"';

    /**
     * @throws FileCannotBeOpenedException
     */
    public function read(string $csvFilePath, array $fields): array
    {
        if (!is_readable($csvFilePath) || !is_file($csvFilePath)) {
            throw new FileCannotBeOpenedException("File {$csvFilePath} is not readable");
        }
        $file = new \SplFileObject($csvFilePath, 'rb');

        $firstLine = trim($file->getCurrentLine());
        $delimiter = $this->detectDelimiter($firstLine);

        $columnIndexToFieldName = explode($delimiter, $firstLine);
        $file->setFlags(\SplFileObject::DROP_NEW_LINE | \SplFileObject::SKIP_EMPTY | \SplFileObject::READ_CSV);
        $file->setCsvControl($delimiter, self::ENCLOSURE);

        $data = [];
        foreach ($file as $rowIndex => $rowValues) {
            if (0 === $rowIndex || false === $rowValues) {
                // Skip the header rowValues and empty lines
                continue;
            }

            $extractedRow = [];
            foreach ($rowValues as $columnIndex => $columnValue) {
                $fieldName = $columnIndexToFieldName[$columnIndex];
                if (\in_array($fieldName, $fields, true)) {
                    $extractedRow[$fieldName] = $columnValue;
                }
            }
            $data[] = $extractedRow;
        }

        return $data;
    }

    private function detectDelimiter(string $headerLine): string
    {
        $delimiters = array_fill_keys(self::ALLOWED_DELIMITERS, 0);
        foreach ($delimiters as $delimiter => &$count) {
            $count = \count(str_getcsv($headerLine, $delimiter));
        }

        return array_search(max($delimiters), $delimiters, true);
    }
}
