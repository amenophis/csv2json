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

        $aggregatorValues = array_unique($fieldValues);
        $newData = array_fill_keys($aggregatorValues, []);

        foreach ($data as $rowIndex => $rowValue) {
            $aggregatorValue = $rowValue[$fieldName];
            unset($rowValue[$fieldName]);

            $newData[$aggregatorValue][] = $rowValue;
        }

        return $newData;
    }
}
