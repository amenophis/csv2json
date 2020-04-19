<?php

namespace Csv2Json;

use Csv2Json\Aggregator\DataAggregator;
use Csv2Json\Encoder\JsonEncoder;
use Csv2Json\Formatter\FieldNotNullableException;
use Csv2Json\Formatter\Type\EmptyFormatterType;
use Csv2Json\Formatter\UnformattableValueException;
use Csv2Json\Reader\CsvReader;
use Csv2Json\Formatter\DataFormatter;
use Csv2Json\Formatter\Type\BooleanFormatterType;
use Csv2Json\Formatter\Type\DatetimeFormatterType;
use Csv2Json\Formatter\Type\DateFormatterType;
use Csv2Json\Formatter\Type\FloatFormatterType;
use Csv2Json\Formatter\Type\IntegerFormatterType;
use Csv2Json\Formatter\Type\StringFormatterType;
use Csv2Json\Formatter\Type\TimeFormatterType;

final class Application
{
    public function run(array $args): int
    {
        $arguments = Arguments::parse($args);
        if ($arguments->hasParsingErrors()) {
            echo 'Errors during arguments parsing :'.PHP_EOL;
            foreach ($arguments->getParsingErrors() as $error) {
                echo "  - {$error}".PHP_EOL;
            }
        }

        $fieldsDescription = new DescriptionFile();
        $mapping = $fieldsDescription->parse($arguments->getDescriptionFilePath());

        $formatter = new DataFormatter($mapping, ...[
            new EmptyFormatterType(),
            new BooleanFormatterType(),
            new DatetimeFormatterType(),
            new DateFormatterType(),
            new FloatFormatterType(),
            new IntegerFormatterType(),
            new StringFormatterType(),
            new TimeFormatterType(),
        ]);

        $reader = new CsvReader();
        $aggregator = new DataAggregator();
        $writer = new JsonEncoder();

        try {
            $data = $reader->read(
                $arguments->getCsvFilePath(),
                $arguments->getFields(),
                $arguments->getAggregate(),
                $formatter
            );
        } catch (FieldNotNullableException|UnformattableValueException $e) {
            print $e->getMessage();

            return 1;
        }

        if ($arguments->getAggregate()) {
            $data = $aggregator->aggregate($data, $arguments->getAggregate());
        }

        print $writer->encode(
            $data,
            $arguments->isPretty()
        );

        return 0;
    }
}