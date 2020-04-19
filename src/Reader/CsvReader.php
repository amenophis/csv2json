<?php

namespace Csv2Json\Reader;

use Csv2Json\Formatter\DataFormatter;

final class CsvReader
{
    private const ALLOWED_DELIMITERS = [',', ';', '|', ' '];
    private const ENCLOSURE = '"';

    private array $columnIndexToFieldName = [];

    public function read(string $csvFilePath, array $fields, ?string $aggregateOnField, DataFormatter $formatter): array
    {
        if (!is_readable($csvFilePath)) {
            throw new \InvalidArgumentException("File {$csvFilePath} is not readable");
        }
        $file = new \SplFileObject($csvFilePath, 'rb');

        $firstLine = trim($file->getCurrentLine());
        $delimiter = $this->detectDelimiter($firstLine);

        foreach (explode($delimiter, $firstLine) as $rowIndex => $field) {
            $fieldName = trim($field);
            $this->columnIndexToFieldName[$rowIndex] = $fieldName;
        }

        $file->setFlags(\SplFileObject::READ_CSV);
        $file->setCsvControl($delimiter, self::ENCLOSURE);

        $data = [];
        foreach($file as $rowIndex => $rowValues) {
            if ($rowIndex === 0) {
                // Skip the header rowValues
                continue;
            }

            $extractedRow = [];
            foreach ($rowValues as $columnIndex => $columnValue) {
                $fieldName = $this->columnIndexToFieldName[$columnIndex];
                if (in_array($fieldName, $fields)) {
                    $extractedRow[$fieldName] = $columnValue;
                }
            }

            $data[] = $formatter->format($extractedRow);
        }

        return $data;
    }

    private function detectDelimiter(string $headerLine): string
    {
        $delimiters = array_fill_keys(self::ALLOWED_DELIMITERS, 0);
        foreach ($delimiters as $delimiter => &$count) {
            $count = count(str_getcsv($headerLine, $delimiter));
        }

        return array_search(max($delimiters), $delimiters);
    }
}