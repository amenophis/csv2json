<?php

namespace Csv2Json\Aggregator;

final class DataAggregator
{
    public function aggregate(array $data, string $fieldName): array
    {
        $aggregatorValues = array_unique(array_column($data, $fieldName));
        $newData = array_fill_keys($aggregatorValues, []);

        foreach ($data as $rowIndex => $rowValue) {
            $aggregatorValue = $rowValue[$fieldName];
            unset($rowValue[$fieldName]);

            $newData[$aggregatorValue][] = $rowValue;
        }

        return $newData;
    }
}