<?php

namespace Csv2Json;

final class CsvParser
{
    /**
     * @var resource
     */
    private $file;

    private function __construct($file)
    {
        $this->file = $file;
    }

    public static function initFromFilePath(string $csvFilePath): self
    {
        if (!is_readable($csvFilePath)) {
            throw new \InvalidArgumentException("File {$csvFilePath} is not readable");
        }

        return new self(fopen($csvFilePath, 'rb'));
    }

    public function getIterator(): iterable
    {
        $line = 1;
        while (($data = fgetcsv($this->file, 10000, ';')) !== FALSE)
        {
            yield $line => $data;
            ++$line;
        }
    }
}