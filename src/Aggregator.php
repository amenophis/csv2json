<?php

namespace Csv2Json;

use Csv2Json\Exception\InvalidFieldException;

final class Aggregator
{
    /**
     * @throws InvalidFieldException
     */
    public function aggregate(array $data, string $fieldName): array
    {
        $fieldValues = array_column($data, $fieldName);
        if ($fieldValues === []) {
            throw InvalidFieldException::create($fieldName);
        }

        $aggregatedData = [];
        foreach ($data as $rowIndex => $rowValue) {
            $aggregatorValue = $rowValue[$fieldName];
            unset($rowValue[$fieldName]);
            $aggregatedData[$this->valueToKey($aggregatorValue)][] = $rowValue;
        }

        return $aggregatedData;
    }

    private function valueToKey($value)
    {
        if (true === $value) {
            return 'true';
        }
        if (false === $value) {
            return 'false';
        }

        return $value;
    }
}
