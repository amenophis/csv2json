<?php

namespace Csv2Json\Aggregator;

use Csv2Json\Aggregator\Exception\InvalidFieldException;

final class Aggregator
{
    /**
     * @throws InvalidFieldException
     */
    public function aggregate(array $data, string $fieldName): array
    {
        $fieldValues = array_column($data, $fieldName);
        if (0 === \count($fieldValues)) {
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
